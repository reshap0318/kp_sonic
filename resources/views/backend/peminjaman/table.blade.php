<div id="cari_barang" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped table-hover" id="tblbarang">
          <thead>
            <tr class="headings">
              <th>Id</th>
              <th>Nomor Serial</th>
              <th>Satker</th>
              <th>Jenis</th>
              <th>Merek</th>
              <th>type</th>
              <th class="no-link last"><span class="nobr">Action</span></th>
            </tr>
          </thead>
          <?php $no=0?>
          <tbody>
            @foreach($barangs as $barang)
              <tr>
                <td>{{$barang->id}}</td>
                <td>{{$barang->no_serial}}</td>
                <td>{{optional($barang->satker)->nama}}</td>
                <td>{{optional($barang->jenis)->nama}}</td>
                <td>{{optional($barang->merek)->nama}}</td>
                <td>{{$barang->type}}</td>
                <td>
                  <button type="button" name="button" id="pilih" class="btn btn-success btn-xs">Select</button>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr class="headings">
              <th>id</th>
              <th>Nomor Serial</th>
              <th>Satker</th>
              <th>Jenis</th>
              <th>Merek</th>
              <th>type</th>
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
    $('#tblbarang tfoot th').each(function(){
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    });

    // DataTable
    var table = $('#tblbarang').DataTable({
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
    $('#tblbarang tbody').on( 'click', 'button', function () {

        var data = $(this).closest("tr")[0].children[0].innerHTML;

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
    });

  });
</script>
@stop
<!-- $('#modal-scan').is(':visible'); untuk menentukan apakah modal terbuka atau tertutup -->
