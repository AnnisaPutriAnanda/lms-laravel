$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var JOB = $('#job').click(function(){

    $('#createButton').html('<button class="btn btn-success plus float-right createJob">Create Job</button>');
    var table = $('#myTable').DataTable({
    destroy : true,
    processing : true,
    serverside : true,
    responsive : true,
    ajax : {  
    url :  "/JobTable", 
    type : "get",
    },
         columns :[ 
         {
             "data" : null, "sortable": false,
             render : function(data, type, row, meta){
                 return meta.row + meta.settings._iDisplayStart + 1
             }
         },
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'created_at', name: 'created_at', "searchable": false},
            {data: 'updated_at', name: 'updated_at', "searchable": false},
            {data: 'action', name: 'action', "searchable": false},
        ],         
})
            
}); //the end of the job table

$('body').on('click', '.editJob', function(e){
e.preventDefault();
var id = $(this).data('id');
$.get("editJob/" + id, function(data){
$('#exampleModalLabelEdit').html('Modal Edit Job');
$('#Modal_edit').modal('show');
$('#id').val(data.id);
$('#name').val(data.name);
})
}); //the end of editJob modal

$('body').on('click', '.submitButti', function(e){
e.preventDefault();
const id = $('[name="id"]').val().trim();
const name = $('[name="name"]').val().trim();

$.ajax({
  type:'POST',
  url: '/updateCreateJob',
  data: {
    "_token" : '{{ csrf_token() }}',
    id : id,
    name : name,
  },
  success: function(data) {
        // JOB.ajax.reload();
        $('#form_of_modal')[0].reset();
        $('#Modal_edit').modal('hide');
        Swal.fire({
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500})},
  error:function(data){
   console.log(data);
   alert("Error Function" + data);
  }
  })


}); //the end of submit job form

$('body').on('click', '.deleteJob', function(e){
e.preventDefault();
var id = $(this).data('id');

Swal.fire({
            title: 'Are You Sure?',
            text: "Want to delete id=" + id + "?",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'CANCEL',
            confirmButtonText: 'YES, DELETE!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "DELETE",
                    url: "{{url('deleteJob')}}/" + id,
                    data: {"_token" : '{{ csrf_token() }}',},
                    success: function(data) {
                    // JOB.ajax.reload();
                    Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500})
                        
                    },
                })
              }
})
}); //the end of deleteJob

$('body').on('click', '.createJob', function(){
$('#form_of_modal')[0].reset();
$('#exampleModalLabelEdit').html('Modal Create Job');
$('#Modal_edit').modal('show');
}); //the end of modal create job