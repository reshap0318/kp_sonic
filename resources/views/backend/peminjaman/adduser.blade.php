<div id="add_user" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => 'user/peminjaman', 'class' => 'form-horizontal','files' => true,'class'=>'form-horizontal form-label-left','data-parsley-validate','id'=>'demo-form2')) }}

          <div class="form-group">
            {!! Form::label('nrp_nip', 'NIP / NRP *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::text('nrp_nip', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('nama', 'Nama *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::text('nama', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('satker_id', 'Satuan kerja *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::select('satker_id', $satker, null, ['class' => 'foselect2_single form-control','placeholder'=>'--- Pilihan Satuan Kerja ---']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('jabatan_id', 'Jabatan *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::select('jabatan_id', $jabatan, null, ['class' => 'foselect2_single form-control','placeholder'=>'--- Pilihan Jabatan ---']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('pangkat_id', 'Pangkat *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::select('pangkat_id', $pangkat, null, ['class' => 'foselect2_single form-control','placeholder'=>'--- Pilihan Pangkat ---']) !!}
            </div>
          </div>

          <div class="form-group">
          {!! Form::label('jenis_kelamin', 'Jenis Kelamin *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
          <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::select('jenis_kelamin', [1=>'Laki - Laki',0=>'Perempuan'], null, ['class' => 'foselect2_single form-control','placeholder'=>'--- Jenis Kelamin ---']) !!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>


        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
