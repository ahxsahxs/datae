<script>
$(function(){
	$('#file').on('success.tools.upload',function(json){
		var txt = '';
		$.each(json,function(key,nome){
			txt += nome+";";
		});
	});
});
</script>