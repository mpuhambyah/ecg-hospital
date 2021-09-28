$('.deleteRecord').on('click', function () {
	const id = $(this).data("id");
	const id_rekaman = $(this).data("id_rekaman");
	$(".delete-btn").attr("href", base + "dokter/deleteRecord/" + id + "/" + id_rekaman);
})
