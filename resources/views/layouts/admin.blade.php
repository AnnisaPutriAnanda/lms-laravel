<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
         <!-- Scripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.min.css" rel="stylesheet">
        <!-- Styles -->
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script id="JS"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
<!-- jQuery -->
<script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/') }}dist/js/demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
    </body>
    
    <script type="text/javascript">   
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(data){
                      
                 $('#job').click(function(){

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
                          url: "{{ url('updateCreateJob') }}",
                          data: {
                            "_token" : '{{ csrf_token() }}',
                            id : id,
                            name : name,
                          },
                          success: function(data) {
                                $('#myTable').DataTable().ajax.reload();
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
                                            url: "deleteJob/" + id,
                                            data: {"_token" : '{{ csrf_token() }}',},
                                            success: function(data) {
                                            $('#myTable').DataTable().ajax.reload();
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
        
                     
// ____________________________________________________________________________________________________________________________________________________________________________________________________________

         $('#personal_goal').click(function(){

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
                          url: "{{ url('updateCreateGoal') }}",
                          data: {
                            "_token" : '{{ csrf_token() }}',
                            id : id,
                            name : name,
                          },
                          success: function(data) {
                                $('#myTable').DataTable().ajax.reload();
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

              $('body').on('click', '.deleteGoal', function(e){
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
                                            url: "deleteGoal/" + id,
                                            data: {"_token" : '{{ csrf_token() }}',},
                                            success: function(data) {
                                            $('#myTable').DataTable().ajax.reload();
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


// ____________________________________________________________________________________________________________________________________________________________________________________________________________
              
$('#tool').click(function(){

var table = $('#myTable').DataTable({
destroy : true,
processing : true,
serverside : true,
responsive : true,
ajax : {  
url :  "/ToolsTable", 
type : "get",
},
     columns :[ 
     {
         "data" : null, "sortable": false,
         render : function(data, type, row, meta){
             return meta.row + meta.settings._iDisplayStart + 1
         }
     },
        {data: 'name', name: 'name'},
        {data: 'image', name: 'image', "searchable": false},
        {data: 'created_at', name: 'created_at', "searchable": false},
        {data: 'action', name: 'action', "searchable": false},
    ],         
})
        
}); //the end of the tool table

                $('body').on('click', 'createTool', function(){
                $('#modal_tool').modal('show');
                $('#exampleModalLabelTool').html('Modal Create Tool');

                }); //the end of modal create tool



            //   (function($){
            //      $(document).on('ajaxError', function(event, xhr) {
            //      if (xhr.status === 401 || xhr.status === 405) {
            //         window.location.reload();
            //     }
            //   });
            //      })(jQuery); //to handle the 403 error


//conditional script load

//     var script = document.getElementsByTagName('head')[0];
    
//     var page = $(".nav ul li a").click(function(e){
//     e.preventDefault();
//     var sectionID = this.getAttribute("id");

//    if(sectionID == 'job'){
    
//        document.getElementById("JS").remove();
//        console.log('page = job');
//        var js = document.createElement("script");
//        js.id = 'JS';
//        js.type = "text/javascript";
//        js.src = '{{ asset("job.js") }}';
//        js.async = false;
//        script.appendChild(js);


//   }else if(sectionID == 'personal_goal'){

//      document.getElementById("JS").remove();
//      console.log('page = goal');
//      var js = document.createElement("script");
//      js.id = 'JS';
//      js.type = "text/javascript";
//      js.src = '{{ asset("goal.js") }}';
//      js.async = false;
//      script.appendChild(js);


//   }else if(sectionID == 'tool'){

//      document.getElementById("JS").remove();
//      console.log('page = tool');
//      var js = document.createElement("script");
//      js.id = 'JS';
//      js.type = "text/javascript";
//      js.src = '{{ asset("tools.js") }}';
//      js.async = false;
//      script.appendChild(js);  

//   }else{

//     console.log('Page default');

// }


// });





});//the end of ready function



     </script>
    
</html>
