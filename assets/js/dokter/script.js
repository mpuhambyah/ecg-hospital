$('.deleteRecord').on('click', function () {
	const id = $(this).data("id");
	const id_rekaman = $(this).data("id_rekaman");
	$(".delete-btn").attr("href", base + "dokter/deleteRecord/" + id + "/" + id_rekaman);
})

$('.deleteRecordPasien').on('click', function () {
	const id = $(this).data("id");
	const id_rekaman = $(this).data("id_rekaman");
	$(".delete-btn").attr("href", base + "alat/deleteRecord/" + id + "/" + id_rekaman);
})

$('.deletePasien').on('click', function () {
	const id = $(this).data("id");
	$(".delete-btn").attr("href", base + "alat/deletePasien/" + id);
})
