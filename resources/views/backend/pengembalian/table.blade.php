<div id="cari_barang" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped table-hover" id="tblpeminjaman">
          <thead>
            <tr class="headings">
              <th class="text-center">No</th>
              <th>Nama </th>
              <th>No Serial</th>
              <th>Jenis </th>
              <th>Merek</th>
              <th>Tanggal </th>
              <th class="no-link last"><span class="nobr">Action</span></th>
            </tr>
          </thead>
          <?php $no=0?>
          <tbody>
            @foreach($peminjamans as $peminjaman)
              <tr>
                  <td class=" text-center">{{ $peminjaman->id }}</td>
                  <td class=" ">{{$peminjaman->user->nama}}</td>
                  <td class=" ">{{$peminjaman->barang->no_serial}}</td>
                  <td class=" ">{{optional(optional($peminjaman->barang)->jenis)->nama}}</td>
                  <td class=" ">{{optional(optional($peminjaman->barang)->merek)->nama}}</td>
                  <td class=" ">{{$peminjaman->tanggal}}</td>
                  <td class=" last">
                    <button type="button" name="button" id="pilih" class="btn btn-success btn-xs">Select</button>
                  </td>
                </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr class="">
              <th class="text-center">No</th>
              <th>Nama </th>
              <th>No Serial</th>
              <th>Jenis </th>
              <th>Merek</th>
              <th>Tanggal </th>
              <th class="no-link last"><span class="nobr">Action</span></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button id="simpan" type="button" class="btn btn-default" data-dismiss="modal">Pilih</button>
      </div>
    </div>
  </div>
</div>

@section('scripts')
<script type="text/javascript">

  $("#barang_id").select2("enable", true);
  
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#tblpeminjaman tfoot th').each(function(){
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    });

    // DataTable
    var table = $('#tblpeminjaman').DataTable({
        "searching":   false,
        "paging":   false,
        "ordering": false,
        "info":     false,
    });

    // Apply the search
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        });
    });


    var pilih = [];
    $('#tblpeminjaman tbody').on( 'click', 'button', function () {
        var data = $(this).closest("tr")[0].children[0].innerHTML;
        if(table.rows('.selected').data().length==0 || $(this).hasClass('btn-danger')){
            $(this).toggleClass('btn-success btn-danger');
            if($(this).hasClass('btn-success')){
              $(this).closest("tr").removeClass('selected');
              $(this).html('Select');

              var index = pilih.indexOf(data);
              if (index > -1) {
                pilih.splice(index, 1);
              }

            }else{
              $(this).html('UnSelect');
              $(this).closest("tr").addClass('selected');
              pilih.push(data);
            }

            console.log(pilih);
            $('#barang_id').val(pilih).trigger('change');
            document.getElementById('hiden').value = $('#barang_id').val();
        }else{
          alert('hanya bisa Memilih Barang');
        }
    });
  });
</script>
@stop
<!-- $('#modal-scan').is(':visible'); untuk menentukan apakah modal terbuka atau tertutup -->
