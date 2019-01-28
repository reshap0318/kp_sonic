
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

<div class="form-group">
  {!! Form::label('role', 'Status *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('role', $role, null, ['class' => 'foselect2_single form-control','placeholder'=>'--- Status ---']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('password', 'Password *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::password('password', ['class' => 'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('password_confirm', 'Password Confirm *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::password('password_confirm', ['class' => 'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('avatar', 'Avatar', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::file('avatar', null, ['class'=>'form-control']) !!}
  </div>
</div>
