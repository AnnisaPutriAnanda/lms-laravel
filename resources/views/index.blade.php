@include('Template.Search')

@include('Template.Navbar')

<div class="content-wrapper">
{{-- form job --}}
  <div class="modal fade" id="Modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        {{--  --}}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelEdit">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{--  --}}
        <div class="modal-body">
          <form method="POST" id="form_of_modal" name="form_of_modal">
            @csrf  
            @method('POST')
            {{ csrf_field() }}
            <input type="hidden" id="id" name="id">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group">
              <label class="col-form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nama.." required>
            </div>
            <button type="submit" id="submit-btn" class="btn btn-primary submitButti">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </form>
        </div>
      {{--  --}}
      </div>
    </div>
  </div>



{{-- form goal --}}
  <div class="modal fade" id="Modal_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCreate" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        {{--  --}}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelCreate">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{--  --}}
        <div class="modal-body">
          <form method="POST" id="form_modal" name="form_modal">
            @csrf  
            @method('POST')
            {{ csrf_field() }}
            <input type="hidden" id="id_field" name="id_field">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group">
              <label class="col-form-label">Name</label>
              <input type="text" class="form-control" id="name_field" name="name_field" placeholder="Nama.." required>
            </div>
            <button type="submit" id="submit-btn" class="btn btn-primary submitButtu">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </form>
        </div>
      {{--  --}}
      </div>
    </div>
  </div>


<!-- Modal tool-->
<div class="modal fade" id="modal_tool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelTool" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelTool">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Admin only content") }}
                    <br/>
                    <div id="createButton"></div>
                    <table id="myTable" class="display table table-bordered" style="width:100%">
                      <thead>
                        <tr>
                           <th >No</th>
                          <th >Name</th>
                          <th >Created</th>
                          <th >Updated</th>
                          <th >Action</th>
                        </tr>
                      </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@include('Template.Sidebar')
</div>
</x-admin-layout>
