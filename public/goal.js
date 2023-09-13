$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

var GOAL = $('#personal_goal').click(function(){

  $('#createButton').html('<button class="btn btn-success plus float-right createGoal">Create Goal</button>');
  var table = $('#myTable').DataTable({
              destroy : true,
              processing : true,
              serverside : true,
              responsive : true,
              ajax : {  
                url :  "/personalGoalTable", 
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
          });
      
  }); //the end of goal table

  $('body').on('click', '.createGoal', function(){
  $('#form_modal')[0].reset();
  $('#exampleModalLabelCreate').html('Modal Create Goal');
  $('#Modal_create').modal('show');
  }); //the end of modal create goal

  $('body').on('click', '.editGoal', function(e){
  e.preventDefault();
  var id = $(this).data('id');
  $.get("editGoal/" + id, function(data){
  $('#exampleModalLabelCreate').html('Modal Edit Goal');
  $('#Modal_create').modal('show');
  $('#id_field').val(data.id);
  $('#name_field').val(data.name);
  })
  }); //the end of modal edit goal

 $('body').on('click', '.submitButtu', function(e){
    e.preventDefault();
    const id = $('[name="id_field"]').val().trim();
    const name = $('[name="name_field"]').val().trim();

         $.ajax({
            type:'POST',
            url: '/updateCreateGoal',
            data: {
              "_token" : '{{ csrf_token() }}',
              id : id,
              name : name,
            },
            success: function(data) {
                  // GOAL.ajax.reload();
                  $('#form_modal')[0].reset();
                  $('#Modal_create').modal('hide');
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

    
}); //the end of submit goal form