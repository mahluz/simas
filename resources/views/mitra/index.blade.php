@extends('layouts/siswa')
@section('content')

  <div class="container">

    <section class="content-header">
              <h1>
                Data Mitra
              </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Mitra</h3>
            </div><!-- /.box-header -->
          </div>
          {{-- end box --}}

              <button type="button" name="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Data</button>
              <div class="box-body">
                <table id="tabel_surat_keluar" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>Created at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($mitra as $index => $ini)
                      <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$ini->nama}}</td>
                        <td>{{$ini->nik}}</td>
                        <td>{{$ini->created_at}}</td>
                        <td>
                          <button type="button" class="btn btn-info" onclick="read({{$ini->id}})">Read more</button>
                          <button type="button" class="btn btn-warning" onclick="edit({{$ini->id}})">Edit</button>
                          <button type="button" class="btn btn-danger" onclick="delete({{$ini->id}})">Delete</button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
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
        <form class="form" action="{{url('admin/mitra/store')}}" method="post">
          <div class="form-group">
            <label for="">Nama Mitra</label>
            <input type="text" class="form-control" name="nama" value="">
          </div>
          <div class="form-group">
            <label for="">NIK</label>
            <input type="text" class="form-control" name="nik" value="">
          </div>
          <div class='form-group'>
            <label for=''>Jenis Kegiatan</label>
            <select name='kegiatan1' class='form-control'>
              @foreach($kegiatan as $index => $ini)
                <option value='{{$ini->id}}'>{{$ini->kegiatan}}</option>
              @endforeach
            </select>
            <input type='text' class='form-control' name='nilaiKegiatan1'>
          </div>
          <input type="hidden" id="totalItem" name="totalItem">
          <div id="myKegiatan">
            
          </div>
          <button type="submit" class="btn btn-success" name="button">Submit</button>
          <button type="button" class="btn btn-info" onclick="addKegiatan();">Add Kegiatan</button>
          <div id="dropKegiatan"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
{{-- end myModal --}}

<!-- Modal -->
  <div class="modal fade" id="readMore" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Kegiatan</th>
                <th>Nilai</th>
              </tr>
            </thead>
            <tbody id="readContent">
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

@endsection
@section('script')
  <script type="text/javascript">
    var totalItem = 1;
    $(document).ready(function(){
      console.log('yey');
      $("#totalItem").val(totalItem);
    });
    function addKegiatan(){

      totalItem += 1;
      $("#totalItem").val(totalItem);
      if(totalItem >= 1 ){
        // console.log("seharusnya bisa");
        $("#dropKegiatan").html(
          "<button id=dropButton type=button class='btn btn-warning' onclick=dropKegiatan(); >Drop Kegiatan</Drop Kegiatan>"
          );
      } //end if

      console.log(totalItem);

      $("#myKegiatan").append(
        "\
        <div class='form-group' id='add"+totalItem+"'>\
            <label for=''>Jenis Kegiatan</label>\
            <select name='kegiatan"+totalItem+"' class='form-control'>\
              @foreach($kegiatan as $index => $ini)\
                <option value='{{$ini->id}}'>{{$ini->kegiatan}}</option>\
              @endforeach\
            </select>\
            <input type='text' class='form-control' name='nilaiKegiatan"+totalItem+"'>\
          </div>\
        "
        )

    }
    //end addkegiatan
    function dropKegiatan(){
      $("#add"+totalItem).remove();
      totalItem -= 1;
      $("#totalItem").val(totalItem);
      if(totalItem <= 1 ){
        console.log("seharusnya bisa");
        $("#dropButton").remove();
      }

      console.log(totalItem);
    }
    //end dropKegiatan
    function read(id){
      // console.log(id);
      var data = {id:id};
      $("#readContent").html("");
      $.post("{{url('admin/mitra/getValue')}}",data,function(result){
        console.log(result);
        $.each(result,function(i,item){
          i+=1;
          $("#readContent").append(
            "\
            <tr>\
              <td>"+i+"</td>\
              <td>"+this.kegiatan+"</td>\
              <td>"+this.value+"</td>\
            </tr>\
            "
            );
        });
      },"json");
      $("#readMore").modal();
    }
  </script>
@endsection
