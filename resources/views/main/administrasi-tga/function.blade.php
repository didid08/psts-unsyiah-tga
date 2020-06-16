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
		} elseif ($administrasi_tga->value('progress') == $progress) {
			return '<i class="fa fa-sync-alt text-info icon-size"></i>';
		} else {
			return '<i class="far fa-circle nonactive icon-size"></i>';
		}
	}

	function progressOptional ($progress_optional, $administrasi_tga) {
		if ($administrasi_tga->value('progress_optional') > $progress_optional) {
			return '<i class="fa fa-check-circle text-green icon-size"></i>';
		} elseif ($administrasi_tga->value('progress_optional') == $progress_optional && $administrasi_tga->value('repeat_optional')) {
			return '<i class="fa fa-times-circle text-red icon-size"></i>';
		} elseif ($administrasi_tga->value('progress_optional') == $progress_optional) {
			return '<i class="fa fa-sync-alt text-info icon-size"></i>';
		} else {
			return '<i class="far fa-circle nonactive icon-size"></i>';
		}
	}

	/* Fungsi untuk manajemen form input */
	function formBackground ($min_progress, $max_progress, $administrasi_tga) {
		if (in_array($administrasi_tga->value('progress'), range($min_progress, $max_progress))) {
			return ' table-light';
		}
		return false;
	}

	function formBackgroundOptional ($min_progress, $max_progress, $administrasi_tga) {
		if (in_array($administrasi_tga->value('progress_optional'), range($min_progress, $max_progress))) {
			return ' table-light';
		}
		return false;
	}
@endphp