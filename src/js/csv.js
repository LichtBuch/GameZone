function openFile(){
	$("#GameFile").click();
}

function fileChanged(input){
	if($(input).val()){
		$("#importForm").submit();
	}
}