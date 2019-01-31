<?php

$menuItems=[
				
		['label' => 'Menu', 'options' => ['class' => 'header']],
		['label' => 'Dashboard', 'icon' => 'desktop', 'url' => ['/site/index'],],
	];
	
$menuItems[] =
	[
		'label' => 'Siswa',
		'icon' => 'user',
		'url' => '#',
		'items' => [
			['label' => 'Input Siswa', 'icon' => 'plus', 'url' => ['/siswa/create'],],
			['label' => 'Data Siswa', 'icon' => 'user', 'url' => ['/siswa/index'],],
			['label' => 'Wali Siswa', 'icon' => 'group', 'url' => ['/wali/index'],],
			['label' => 'Galeri Siswa', 'icon' => 'image', 'url' => ['/siswa/galeri'],],
		],
	];

$menuItems[] =
	[
		'label' => 'KBM',
		'icon' => 'graduation-cap',
		'url' => '#',
		'items' => [
			['label' => 'Kelas', 'icon' => 'sitemap', 'url' => ['/kelas/index'],],
			['label' => 'Jadwal Pelajaran', 'icon' => 'calendar', 'url' => ['/jadwal/index'],],
			['label' => 'Absensi', 'icon' => 'clock-o', 'url' => ['/absensi/index'],],
			['label' => 'Nilai', 'icon' => 'file-o', 'url' => ['/nilai/index'],],
			['label' => 'Kalender Akademik', 'icon' => 'calendar', 'url' => ['/calendar/index'],],
			['label' => 'Event Sekolah', 'icon' => 'calendar', 'url' => ['/event/index'],],
		],
	];

$menuItems[] =
	[
		'label' => 'BK',
		'icon' => 'warning',
		'url' => '#',
		'items' => [
			['label' => 'Pelanggaran Siswa', 'icon' => 'warning', 'url' => ['/siswarecord/index'],],
			
		],
	];

$menuItems[] =
	[
		'label' => 'Sosial',
		'icon' => 'group',
		'url' => '#',
		'items' => [
			['label' => 'Pengumuman', 'icon' => 'rss', 'url' => ['/pengumuman/index'],],
			['label' => 'Galeri Siswa', 'icon' => 'image', 'url' => ['/galery/index'],],
			['label' => 'Galeri Album', 'icon' => 'folder-open-o', 'url' => ['/galeryalbum/index'],],
		],
	];
$menuItems[] =
	[
		'label' => 'Personalia',
		'icon' => 'sitemap',
		'url' => '#',
		'items' => [
			['label' => 'Pegawai', 'icon' => 'sitemap', 'url' => ['/pegawai/index'],],
			['label' => 'Guru', 'icon' => 'calendar', 'url' => ['/guru/index'],],
		],
	];

$menuItems[] =
	[
		'label' => 'Master Data',
		'icon' => 'tasks',
		'url' => '#',
		'items' => [
			['label' => 'Bidang Studi', 'icon' => 'folder-open', 'url' => ['/bidangstudi/index'],],
			['label' => 'Program Studi', 'icon' => 'folder-open-o', 'url' => ['/programstudi/index'],],
			['label' => 'Kompetensi', 'icon' => 'folder-open-o', 'url' => ['/kompetensi/index'],],
			['label' => 'Group Pelajaran', 'icon' => 'sitemap', 'url' => ['/pelajarangroup/index'],],
			['label' => 'Pelajaran', 'icon' => 'file-o', 'url' => ['/pelajaran/index'],],
			['label' => 'Pendidikan', 'icon' => 'file-o', 'url' => ['/pendidikan/index'],],
			['label' => 'Pekerjaan', 'icon' => 'file-o', 'url' => ['/pekerjaan/index'],],
			['label' => 'Pelanggaran', 'icon' => 'warning', 'url' => ['/pelanggaran/index'],],
		],
	];
	
$menuItems[] =
	[
		'label' => 'Membership',
		'icon' => 'refresh',
		'url' => '#',
		'items' => [
			['label' => 'Member', 'icon' => 'user', 'url' => ['/member/index'],],
			['label' => 'Blocked Member', 'icon' => 'ban', 'url' => ['/member/blocked'],],
			['label' => 'Paket Harga', 'icon' => 'money', 'url' => ['/plan/index'],],
			['label' => 'Pembayaran Masuk', 'icon' => 'money', 'url' => ['/payment/index'],],
			['label' => 'Pembayaran Diterima', 'icon' => 'money', 'url' => ['/payment/received'],],
		]
	
	];

$menuItems[] =
	[
		'label' => 'SMS Gateway',
		'icon' => 'envelope',
		'url' => '#',
		'items' => [
			['label' => 'Kirim Pesan', 'icon' => 'envelope', 'url' => ['/sms/sent'],],
			['label' => 'Broadcast', 'icon' => 'rss', 'url' => ['/sms/broadcast'],],
			['label' => 'Pesan Masuk', 'icon' => 'envelope', 'url' => ['/sms/inbox'],],
			['label' => 'Draft', 'icon' => 'file-o', 'url' => ['/sms/draft'],],
			['label' => 'Phonebook', 'icon' => 'address-card', 'url' => ['/sms/phonebook'],],
		]
	
	];
	
$menuItems[] =
	[
		'label' => 'Menu Saya',
		'icon' => 'user',
		'url' => '#',
		'items' => [
			['label' => 'Profil Saya', 'icon' => 'dedent', 'url' => ['/user/profile'],],
			['label' => 'Ganti Password', 'icon' => 'key', 'url' => ['/user/gantipass'],],
		]
	
	];

?>
<?= dmstr\widgets\Menu::widget(
		[
			'options' => ['class' => 'sidebar-menu'],
			'items' => $menuItems,
		]
	) ?>