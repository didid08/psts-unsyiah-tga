@php
	/* Fungsi untuk manajemen background tiap baris */

	function background ($min_progress, $max_progress, $disposisi) {
		if ($disposisi->progress > $max_progress) {
			return 'table-success';
		} elseif (in_array($disposisi->progress, range($min_progress, $max_progress))) {
			return 'table-info';
		}
	}

	function backgroundOptional ($min_progress, $max_progress, $disposisi) {
		if ($disposisi->progress_optional > $max_progress) {
			return 'table-success';
		} elseif (in_array($disposisi->progress_optional, range($min_progress, $max_progress))) {
			return 'table-warning';
		}
	}

	/* Fungsi untuk manajemen status progress */

	function progress ($progress, $disposisi) {
		if ($disposisi->progress > $progress) {
			return '<i class="fa fa-check-circle text-green icon-size"></i>';
		} elseif ($disposisi->progress == $progress) {
			return '<i class="fa fa-sync text-info icon-size"></i>';
		} else {
			return '<i class="far fa-circle nonactive icon-size"></i>';
		}
	}

	function progressOptional ($progress_optional, $disposisi) {
		if ($disposisi->progress_optional > $progress_optional) {
			return '<i class="fa fa-check-circle text-green icon-size"></i>';
		} elseif ($disposisi->progress_optional == $progress_optional) {
			return '<i class="fa fa-sync text-warning icon-size"></i>';
		} else {
			return '<i class="far fa-circle nonactive icon-size"></i>';
		}
	}

	/* Fungsi untuk manajemen form input */
	function formBackground ($min_progress, $max_progress, $disposisi) {
		if (in_array($disposisi->progress, range($min_progress, $max_progress))) {
			return ' table-light';
		}
		return false;
	}

	function formBackgroundOptional ($min_progress, $max_progress, $disposisi) {
		if (in_array($disposisi->progress_optional, range($min_progress, $max_progress))) {
			return ' table-light';
		}
		return false;
	}
@endphp