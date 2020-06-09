@php

	/* Fungsi untuk manajemen form input */
	function formBackground ($min_progress, $max_progress, $administrasi_tga) {
		/*if ( >= $min_progress
			&& $administrasi_tga->value('progress') <= $max_progress) {
			return ' table-light';
		}*/
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