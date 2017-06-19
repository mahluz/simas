@extends('layouts/siswa')
@section('content')

  <div class="container">

    <section class="content-header">
              <h1>
                Data Kegiatan
              </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kegiatan</h3>
            </div><!-- /.box-header -->
          </div>
          {{-- end box --}}

              <button type="button" name="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Data</button>
              <div class="box-body">
                <table id="tabel_surat_keluar" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kegiatan</th>
                      <th>Created at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($kegiatan as $index => $ini)
                    <tr>
                      <td>{{$index+1}}</td>
                      <td>{{$ini->kegiatan}}</td>
                      <td>{{$ini->created_at}}</td>
                      <td>
                        <button type="button" class="btn btn-warning">Edit</button>
                        <button type="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('delete{{$ini->id}}').submit();">Delete</button>
                        <form id="delete{{$ini->id}}" method="post" action="{{url('admin/kegiatan/delete')}}">
                          <input type="hidden" name="id" value="{{$ini->id}}">
                        </form>
                        <form id="update{{$ini->id}}" method="post" action="{{url('admin/kegiatan/delete')}}">
                          <input type="hidden" name="id" value="{{$ini->id}}">
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </tr>
                  </tfoot>
                </table>
              </div><!-- /.box-body -->

          </div><!-- /.box -->
        </div><!-- /.col -->
    </section><!-- /.content -->

  </div>
  {{-- end container --}}

  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Input</h4>
      </div>
      <div class="modal-body">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Input new Data</h3>
          </div><!-- /.box-header -->
        </div>
        {{-- end box --}}
        <form class="form" action="{{url('admin/kegiatan/store')}}" method="post">
          <div class="form-group">
            <label for="">Nama Kegiatan</label>
            <input type="text" class="form-control" name="kegiatan" value="">
          </div>
          <button type="submit" class="btn btn-success" name="button">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
{{-- end myModal --}}

@endsection
