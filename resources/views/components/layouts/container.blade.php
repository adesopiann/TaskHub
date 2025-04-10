<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TaskHub by Ade Sopian</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

    @include('components.navbar')

    <main>
        @yield('main')
    </main>

    

    <script>
        feather.replace();
        
        // Membuka modal detail
        document.addEventListener("DOMContentLoaded", function () {
            const openDetailModalButtons = document.querySelectorAll(".openDetailModal");
            const overlay = document.getElementById("overlay");

            openDetailModalButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const taskId = this.getAttribute("data-id"); 
                    const modal = document.getElementById(`detailModal-${taskId}`);

                    if (modal) {
                        modal.classList.remove("hidden");
                        overlay.classList.remove("hidden");
                    } else {
                        console.error(`Modal dengan ID detailModal-${taskId} tidak ditemukan!`);
                    }
                });
            });

            overlay.addEventListener("click", function () {
            const modals = document.querySelectorAll("[id^='detailModal-']");
            for (let modal of modals) {
                overlay.classList.add("hidden");
                modal.classList.add("hidden");
            }

            });
        });


        //  Membuka modal Edit
        document.addEventListener("DOMContentLoaded", function () {
            const openEditModalButtons = document.querySelectorAll(".openEditModal");
            const closeEditModalButtons = document.querySelectorAll(".closeEditModal");

            openEditModalButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    const taskId = this.getAttribute("data-id");
                    document.getElementById(`editTaskModal-${taskId}`).classList.remove("hidden");
                    document.getElementById('overlay').classList.remove("hidden");
                });
            });

            closeEditModalButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    const taskId = this.getAttribute("data-id");
                    document.getElementById(`editTaskModal-${taskId}`).classList.add("hidden");
                    document.getElementById('overlay').classList.add("hidden");
                });
            });
        });

    document.addEventListener("DOMContentLoaded", function () {
        const fileModal = document.getElementById("fileModal");
        const closeFileModal = document.getElementById("closeFileModal");
        const fileFrame = document.getElementById("fileFrame");
        const fileImage = document.getElementById("fileImage"); 
        const fileFallbackMessage = document.getElementById("fileFallbackMessage"); 
        const fileNameDisplay = document.getElementById("fileName");
        const uploadTimeDisplay = document.getElementById("uploadTime");
        const attachmentLinks = document.querySelectorAll(".open-file-modal");
        const downloadButton = document.getElementById("downloadFile");

        attachmentLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                event.preventDefault();

                const fileData = JSON.parse(this.getAttribute("data-file"));
                const fileUrl = fileData.url;
                const fileName = fileData.name;
                const uploadedAt = new Date(fileData.uploaded_at);

                const isImage = /\.(jpg|jpeg|png|gif|webp)$/i.test(fileName);
                const isInlinePreviewable = /\.(pdf)$/i.test(fileName); 

                fileImage.classList.add("hidden");
                fileFrame.classList.add("hidden");
                fileFallbackMessage.classList.add("hidden");

                if (isImage) {
                    fileImage.src = fileUrl;
                    fileImage.classList.remove("hidden");
                } else if (isInlinePreviewable) {
                    fileFrame.src = fileUrl;
                    fileFrame.classList.remove("hidden");
                } else {
                    fileFallbackMessage.classList.remove("hidden");
                }

                fileNameDisplay.textContent = fileName;
                uploadTimeDisplay.textContent = 'Added ' + uploadedAt.toLocaleString('en-US', {
                    timeZone: 'Asia/Jakarta',
                    year: 'numeric',
                    month: 'short',   
                    day: 'numeric',   
                    hour: 'numeric',  
                    minute: '2-digit',
                    hour12: true      
                });
                downloadButton.href = fileUrl;
                downloadButton.download = fileName;
                downloadButton.classList.remove("hidden");

                fileModal.classList.remove("hidden");
            });
        });

        closeFileModal.addEventListener("click", function () {
            fileModal.classList.add("hidden");
            fileFrame.src = "";
            fileImage.src = "";
        });
    });

    document.getElementById('openDeleteModal').addEventListener('click', function() {
        // Menampilkan modal
        document.getElementById('deleteModal').classList.remove('hidden');
    });

    document.getElementById('cancelDelete').addEventListener('click', function() {
        // Menyembunyikan modal
        document.getElementById('deleteModal').classList.add('hidden');
    });

    
    </script>
    @yield('script')
</body>

</html>
