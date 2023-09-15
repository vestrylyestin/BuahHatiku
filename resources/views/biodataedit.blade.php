@extends('layouts.app')

@section('dashboard')

<!-- Title -->
<div class="row heading-bg  bg-red">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-light">analytical</h5>
	</div>
	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="index.html">Dashboard</a></li>
			<li><a href="#"><span>dashboard</span></a></li>
			<li class="active"><span>analytical</span></li>
		</ol>
	</div>
	<!-- /Breadcrumb -->

</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark">Biodata Anak</h6>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<div class="form-wrap">
								<form action="/biodata_edit" method="POST">
									{{ csrf_field() }}
									<div class="form-body">
										<input type="hidden" name="IdAnak" value="{{$biodata->IdAnak}}">
										<h6 class="txt-dark capitalize-font"><i class="icon-user mr-10"></i>Informasi Anak</h6>
										<hr>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Nama</label>
													<input type="text" id="firstName" class="form-control" name="Nama" placeholder="Isi Nama Anak" value="{{$biodata->Nama}}">
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Anak Ke...</label>
													<input type="number" id="lastName" class="form-control" name="AnakKe" placeholder="Anak ke..." value="{{$biodata->AnakKe}}">
												</div>
											</div>
											<!--/span-->
										</div>
										<!-- /Row -->
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Jenis Kelamin</label>
													<select class="form-control" name="JenisKelamin">
														<option @if ($biodata->JenisKelamin == "Laki-laki") selected @endif value="Laki-laki">Laki-laki</option>
														<option @if ($biodata->JenisKelamin == "Perempuan") selected @endif value="Perempuan">Perempuan</option>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Tanggal Lahir</label>
													<input type="date" class="form-control" name="TglLahir" value="{{$biodata->TglLahir}}">
												</div>
											</div>
										</div>
										<!-- /Row -->
										<div class="row">
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Tempat Lahir</label>
													<input type="text" class="form-control" name="TempatLahir" placeholder="Isi Tempat Lahir" value="{{$biodata->TempatLahir}}">
												</div>
											</div>
											<!--/span-->
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Pendidikan</label>
													<select name="Pendidikan" class="form-control">
													<option @if($biodata->Pendidikan == "PAUD") selected @endif value="PAUD">Pendidikan Anak Usia Dini (PAUD)</option>
													<option @if($biodata->Pendidikan == "SD") selected @endif value="SD">Sekolah Dasar (SD)</option>
													<option @if($biodata->Pendidikan == "SMP") selected @endif value="SMP">Sekolah Menengah Pertama (SMP)</option>
													<option @if($biodata->Pendidikan == "SMA") selected @endif value="SMA">Sekolah Menengah Atas (SMA)</option>
													<option @if($biodata->Pendidikan == "SMK") selected @endif value="SMK">Sekolah Menengah Kejuruan (SMK)</option>
													<option @if($biodata->Pendidikan == "Perguruan_Tinggi_S1") selected @endif value="Perguruan_Tinggi_S1">Perguruan Tinggi (Sarjana - S1)</option>
													<option @if($biodata->Pendidikan == "Perguruan_Tinggi_S2") selected @endif value="Perguruan_Tinggi_S2">Perguruan Tinggi (Magister - S2)</option>
													<option @if($biodata->Pendidikan == "Perguruan_Tinggi_S3") selected @endif value="Perguruan_Tinggi_S3">Perguruan Tinggi (Doktor - S3)</option>
													<option @if($biodata->Pendidikan == "Madrasah_Ibtidaiyah") selected @endif value="Madrasah_Ibtidaiyah">Madrasah Ibtidaiyah (MI)</option>
													<option @if($biodata->Pendidikan == "Madrasah_Tsanawiyah") selected @endif value="Madrasah_Tsanawiyah">Madrasah Tsanawiyah (MTs)</option>
													<option @if($biodata->Pendidikan == "Madrasah_Aliyah") selected @endif value="Madrasah_Aliyah">Madrasah Aliyah (MA)</option>
													<option @if($biodata->Pendidikan == "Pendidikan_Khusus") selected @endif value="Pendidikan_Khusus">Pendidikan Khusus</option>
													</select>
													
												</div>
											</div>
											<!--/span-->
											<!--/span-->
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label mb-5">Diagnosa</label>
													<div class="radio-list">
														<div class="radio-inline pl-0">
															<span class="radio radio-info">
																<input type="radio" name="Diagnosa" @if($biodata->IdDiagnosa == 1) selected @endif id="hiperaktif" value="1">
																<label for="hiperaktif">Hiperaktif</label>
															</span>
														</div>
														<div class="radio-inline">
															<span class="radio radio-info">
																<input type="radio" name="Diagnosa" @if($biodata->IdDiagnosa == 2) selected @endif id="autis" value="2">
														<label for="autis">Autis</label>
														</span>
														</div>
														<div class="radio-inline">
															<span class="radio radio-info">
																<input type="radio" name="Diagnosa" @if($biodata->IdDiagnosa == 3) selected @endif id="speech_delay" value="3">
														<label for="speech_delay">Speech Delay</label>
														</span>
														</div>
														<div class="radio-inline">
															<span class="radio radio-info">
																<input type="radio" name="Diagnosa" @if($biodata->IdDiagnosa == 4) selected @endif id="adhd" value="4">
														<label for="adhd">ADHD</label>
														</span>
														</div>
														<div class="radio-inline">
															<span class="radio radio-info">
																<input type="radio" name="Diagnosa" @if($biodata->IdDiagnosa == 5) selected @endif id="lainnya" value="5">
														<label for="lainnya">Lainnya</label>
														</span>
														</div>
													</div>
													<textarea name="KeteranganDiagnosa" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Diagnosa...">{{$biodata->KeteranganDiagnosa}}</textarea>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-12 ">
												<div class="form-group">
													<label class="control-label mb-10">Yang Mendiagnosa</label>
													<input type="text" class="form-control" name="YangMendiagnosa" placeholder="Silahkan Isi Form ini..." value="{{$biodata->YangMendiagnosa}}">
												</div>
											</div>
										</div>
										<!-- /Row -->
										
										<div class="seprator-block"></div>
										
										<h6 class="txt-dark capitalize-font"><i class="icon-notebook mr-10"></i>Data Orang tua</h6>
										<hr>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Nama Bapak</label>
													<input type="text" class="form-control" name="NamaBapak" placeholder="Isi Nama Bapak" value="{{$biodata->NamaBapak}}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Nama Ibu</label>
													<input type="text" class="form-control" name="NamaIbu" placeholder="Isi Nama Ibu" value="{{$biodata->NamaIbu}}">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Pendidikan Bapak</label>
													<select name="PendBapak" class="form-control">
														<option @if($biodata->PendBapak == "PAUD") selected @endif value="PAUD">Pendidikan Anak Usia Dini (PAUD)</option>
														<option @if($biodata->PendBapak == "SD") selected @endif value="SD">Sekolah Dasar (SD)</option>
														<option @if($biodata->PendBapak == "SMP") selected @endif value="SMP">Sekolah Menengah Pertama (SMP)</option>
														<option @if($biodata->PendBapak == "SMA") selected @endif value="SMA">Sekolah Menengah Atas (SMA)</option>
														<option @if($biodata->PendBapak == "SMK") selected @endif value="SMK">Sekolah Menengah Kejuruan (SMK)</option>
														<option @if($biodata->PendBapak == "Perguruan_Tinggi_S1") selected @endif value="Perguruan_Tinggi_S1">Perguruan Tinggi (Sarjana - S1)</option>
														<option @if($biodata->PendBapak == "Perguruan_Tinggi_S2") selected @endif value="Perguruan_Tinggi_S2">Perguruan Tinggi (Magister - S2)</option>
														<option @if($biodata->PendBapak == "Perguruan_Tinggi_S3") selected @endif value="Perguruan_Tinggi_S3">Perguruan Tinggi (Doktor - S3)</option>
														<option @if($biodata->PendBapak == "Madrasah_Ibtidaiyah") selected @endif value="Madrasah_Ibtidaiyah">Madrasah Ibtidaiyah (MI)</option>
														<option @if($biodata->PendBapak == "Madrasah_Tsanawiyah") selected @endif value="Madrasah_Tsanawiyah">Madrasah Tsanawiyah (MTs)</option>
														<option @if($biodata->PendBapak == "Madrasah_Aliyah") selected @endif value="Madrasah_Aliyah">Madrasah Aliyah (MA)</option>
														<option @if($biodata->PendBapak == "Pendidikan_Khusus") selected @endif value="Pendidikan_Khusus">Pendidikan Khusus</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Pendidikan Ibu</label>
													<select name="PendIbu" class="form-control">
														<option @if($biodata->PendIbu == "PAUD") selected @endif value="PAUD">Pendidikan Anak Usia Dini (PAUD)</option>
														<option @if($biodata->PendIbu == "SD") selected @endif value="SD">Sekolah Dasar (SD)</option>
														<option @if($biodata->PendIbu == "SMP") selected @endif value="SMP">Sekolah Menengah Pertama (SMP)</option>
														<option @if($biodata->PendIbu == "SMA") selected @endif value="SMA">Sekolah Menengah Atas (SMA)</option>
														<option @if($biodata->PendIbu == "SMK") selected @endif value="SMK">Sekolah Menengah Kejuruan (SMK)</option>
														<option @if($biodata->PendIbu == "Perguruan_Tinggi_S1") selected @endif value="Perguruan_Tinggi_S1">Perguruan Tinggi (Sarjana - S1)</option>
														<option @if($biodata->PendIbu == "Perguruan_Tinggi_S2") selected @endif value="Perguruan_Tinggi_S2">Perguruan Tinggi (Magister - S2)</option>
														<option @if($biodata->PendIbu == "Perguruan_Tinggi_S3") selected @endif value="Perguruan_Tinggi_S3">Perguruan Tinggi (Doktor - S3)</option>
														<option @if($biodata->PendIbu == "Madrasah_Ibtidaiyah") selected @endif value="Madrasah_Ibtidaiyah">Madrasah Ibtidaiyah (MI)</option>
														<option @if($biodata->PendIbu == "Madrasah_Tsanawiyah") selected @endif value="Madrasah_Tsanawiyah">Madrasah Tsanawiyah (MTs)</option>
														<option @if($biodata->PendIbu == "Madrasah_Aliyah") selected @endif value="Madrasah_Aliyah">Madrasah Aliyah (MA)</option>
														<option @if($biodata->PendIbu == "Pendidikan_Khusus") selected @endif value="Pendidikan_Khusus">Pendidikan Khusus</option>
													</select>
												</div>
											</div>
											<div class="col-md-12 ">
												<div class="form-group">
													<label class="control-label mb-10">Alamat</label>
													<textarea type="text" class="form-control" rows="7" name="Alamat" placeholder="Silahkan Isi Form ini...">{{$biodata->Alamat}}</textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Tanggal Lahir Bapak/Ibu</label>
													<input type="date" class="form-control" name="TglLahirOrtu" value="{{$biodata->TglLahirOrtu}}">
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Phone Number</label>
													<input type="number" class="form-control" name="NoHP" value="{{$biodata->NoHP}}">
												</div>
											</div>
											<!--/span-->
										</div>
										<!-- /Row -->
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label mb-10">E-mail</label>
													<input type="email" class="form-control" name="Email" value="{{$biodata->Email}}">
												</div>
											</div>
										</div>
										<label class="control-label mb-10">Foto</label>
										<input type="file" id="input-file-now" class="dropify" name="photo" data-allowed-file-extensions="jpg png jpeg" />
									</div>
									<div class="form-actions mt-10">
										<button type="submit" class="btn btn-success  mr-10"> Save</button>
										<button type="button" class="btn btn-default">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Row -->





@endsection