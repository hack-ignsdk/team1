$(document).ready(function(){
	var nim;

	$('#pesan_merah, #pesan_hijau').hide();

	$(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });

	$('#nim').click(function(){
		$('#pesan_merah, #pesan_hijau').fadeOut(300);
		$('label').css('margin-top', '25%');

	});

	$('#cari').click(function(){
		nim = $('#nim').val();
		$('#nim_user').html(nim);
		$('#nim_user_hijau').html(nim);
		$('label').css('margin-top', '10%');
		//$('#pesan_merah').fadeIn(300);
		
		$.getJSON('http://192.168.0.111/latihan/ignsdk_json_interface.php?nim='+nim, function(data){
			if(data.hasil==0)
			{
				$('label').css('margin-top', '10%');
				$('#pesan_merah').fadeIn(300);
			}
			else if(data.hasil==1)
			{
				$('label').css('margin-top', '10%');
				$('#pesan_hijau').fadeIn(300);
			}
		});
	});

	$('#tombol_cetak').click(function(){
		var currentYear = (new Date).getFullYear();
		ign.exec('firefox http://192.168.0.111/latihan/ignsdk_data_surat_bebas.php?nim='+nim);
	});

});