@php
	function namaFile ($tahap, $role) {
		$path = 'main.administrasi-tga.';
		return $path.$role.'.'.$tahap;
	}

	/* Fungsi untuk manajemen background tiap baris */

	function background ($min_progress, $max_progress, $administrasi_tga) {
		if ($administrasi_tga->value('progress') > $max_progress) {
			return 'table-success';
		} elseif (in_array($administrasi_tga->value('progress'), range($min_progress, $max_progress))) {
			if ($administrasi_tga->value('repeat')) {
				return 'table-danger';
			} else {
				return 'table-primary';
			}
		}
	}

	function backgroundOptional ($min_progress, $max_progress, $administrasi_tga) {
		if ($administrasi_tga->value('progress_optional') > $max_progress) {
			return 'table-success';
		} elseif (in_array($administrasi_tga->value('progress_optional'), range($min_progress, $max_progress))) {
			if ($administrasi_tga->value('repeat_optional')) {
				return 'table-danger';
			} else {
				return 'table-warning';
			}
		}
	}

	/* Fungsi untuk manajemen status progress */

	function progress ($progress, $administrasi_tga) {
		if ($administrasi_tga->value('progress') > $progress) {
			return '<i class="fa fa-check-circle text-green icon-size"></i>';
		} elseif ($administrasi_tga->value('progress') == $progress && $administrasi_tga->value('repeat')) {
			return '<i class="fa fa-times-circle text-red icon-size"></i>';
		} else {
			return '<i class="fa fa-circle nonactive icon-size"></i>';
		}
	}

	function progressOptional ($progress_optional, $administrasi_tga) {
		if ($administrasi_tga->value('progress_optional') > $progress_optional) {
			return '<i class="fa fa-check-circle text-green icon-size"></i>';
		} elseif ($administrasi_tga->value('progress_optional') == $progress_optional && $administrasi_tga->value('repeat_optional')) {
			return '<i class="fa fa-times-circle text-red icon-size"></i>';
		} else {
			return '<i class="fa fa-circle nonactive icon-size"></i>';
		}
	}

	function alert($type, $text, $colspan) {
		if ($type == 'danger') {

			$icon = 'fa-exclamation-triangle';

			$bg1 = 'bg-alert-danger-1';
			$bg2 = 'bg-alert-danger-2';
		}
		return '<tr>
					<td colspan="'.$colspan.'" class="text-center align-middle">
						<table width="100%" class="table-borderless">
							<tr>
								<td class="text-center align-middle p-4 '.$bg1.'"><i class="fa '.$icon.' text-white"></i></td>
								<td class="text-left align-middle '.$bg2.'">'.$text.'</td>
							</tr>
						</table>
					</td>
				</tr>';
	}
@endphp