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
            const fileVideo = document.getElementById("fileVideo");
            const videoSource = document.getElementById("videoSource");

            attachmentLinks.forEach(link => {
                link.addEventListener("click", function (event) {
                    event.preventDefault();

                    const fileData = JSON.parse(this.getAttribute("data-file"));
                    const fileUrl = fileData.url;
                    const fileName = fileData.name;
                    const uploadedAt = new Date(fileData.uploaded_at);

                    const isImage = /\.(jpg|jpeg|png|gif|webp)$/i.test(fileName);
                    const isInlinePreviewable = /\.(pdf)$/i.test(fileName); 
                    const isVideo = /\.(mp4|mov)$/i.test(fileName);

                    fileImage.classList.add("hidden");
                    fileFrame.classList.add("hidden");
                    fileVideo.classList.add("hidden");
                    fileFallbackMessage.classList.add("hidden");

                if (isImage) {
                        fileImage.src = fileUrl;
                        fileImage.classList.remove("hidden");
                    } else if (isInlinePreviewable) {
                        fileFrame.src = fileUrl;
                        fileFrame.classList.remove("hidden");
                    } else if (isVideo) {
                        videoSource.src = fileUrl;
                        fileVideo.load(); 
                        fileVideo.classList.remove("hidden");
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

        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const deleteForm = document.getElementById('deleteForm');
            let currentTaskId = null;

            // Menambahkan event listener pada tombol Delete
            const deleteButtons = document.querySelectorAll('.openDeleteModal');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Ambil ID task dari atribut data-task-id
                    currentTaskId = button.closest('.card-task').dataset.taskId;
                    
                    // Ubah action form untuk task yang sesuai
                    deleteForm.action = `/task/${currentTaskId}`;  // Pastikan URL sesuai dengan route DELETE
                    deleteModal.classList.remove('hidden');  // Tampilkan modal
                });
            });

            // Menutup modal jika cancel di klik
            cancelDelete.addEventListener('click', function () {
                deleteModal.classList.add('hidden');  // Sembunyikan modal
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Tombol kategori
            const showOpen = document.getElementById('showOpen');
            const showInProgress = document.getElementById('showInProgress');
            const showDone = document.getElementById('showDone');

            // Elemen tugas
            const openTasks = document.getElementById('openTasks');
            const inProgressTasks = document.getElementById('inProgressTasks');
            const doneTasks = document.getElementById('doneTasks');

            // Semua tombol dalam satu array untuk loop
            const buttons = [showOpen, showInProgress, showDone];

            function setActiveButton(activeButton) {
                buttons.forEach(button => {
                    if (button === activeButton) {
                        button.classList.remove('bg-white', 'text-blue-500');
                        button.classList.add('bg-blue-500', 'text-white');
                    } else {
                        button.classList.remove('bg-blue-500', 'text-white');
                        button.classList.add('bg-white', 'text-blue-500');
                    }
                });
            }

            function hideAllTasks() {
                openTasks.classList.add('hidden');
                inProgressTasks.classList.add('hidden');
                doneTasks.classList.add('hidden');
            }

            showOpen.addEventListener('click', function () {
                hideAllTasks();
                openTasks.classList.remove('hidden');
                setActiveButton(showOpen);
            });

            showInProgress.addEventListener('click', function () {
                hideAllTasks();
                inProgressTasks.classList.remove('hidden');
                setActiveButton(showInProgress);
            });

            showDone.addEventListener('click', function () {
                hideAllTasks();
                doneTasks.classList.remove('hidden');
                setActiveButton(showDone);
            });

            // Default view
            showOpen.click();
        });


    // Logout Modal
    document.addEventListener('DOMContentLoaded', function () {
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogout = document.getElementById('cancelLogout');
        const logoutForm = document.getElementById('logoutForm');

        // Menambahkan event listener pada tombol Delete
        const logoutButtons = document.querySelectorAll('.openLogoutModal');
        logoutButtons.forEach(button => {
            button.addEventListener('click', function () {
                logoutModal.classList.remove('hidden');  
            });
        });

        // Menutup modal jika cancel di klik
        cancelLogout.addEventListener('click', function () {
            logoutModal.classList.add('hidden');  // Sembunyikan modal
        });
    });

        document.addEventListener("DOMContentLoaded", function () {
        const burgerBtn = document.getElementById('burgerBtn');
        const userMenu = document.getElementById('userMenu');

        burgerBtn?.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });
    });


    </script>
    @yield('script')
</body>

</html>
