import "./bootstrap";

import feather from "feather-icons";

document.addEventListener("DOMContentLoaded", function () {
    feather.replace();

    //  ===== AddTask Modal =====
    const openAddModal = document.getElementById("openModalAdd");
    const addTaskModal = document.getElementById("addTaskModal");
    const overlay = document.getElementById("overlay");
    const closeAddModal = document.getElementById("closeAddModal");

    // Tampilkan modal saat tombol "Add Task" diklik
    openAddModal.addEventListener("click", function () {
        console.log("Klik tombol Add Task");
        addTaskModal.classList.remove("hidden");
        overlay.classList.remove("hidden");
    });

    // Menutup Modal
    closeAddModal.addEventListener("click", function () {
        addTaskModal.classList.add("hidden");
        overlay.classList.add("hidden");
    });

    // Tutup modal saat klik di luar modal
    overlay.addEventListener("click", function (event) {
        if (event.target === overlay) {
            addTaskModal.classList.add("hidden");
            overlay.classList.add("hidden");
        }
    });

    // ===== Detail Modal =====
    const overlayDetail = document.getElementById("overlay");

    document.querySelectorAll(".openDetailModal").forEach((button) => {
        button.addEventListener("click", function () {
            const taskId = this.getAttribute("data-id");
            const modal = document.getElementById(`detailModal-${taskId}`);
            if (modal) {
                modal.classList.remove("hidden");
                overlayDetail.classList.remove("hidden");
            }
        });
    });

    // Saat overlay diklik, sembunyikan semua modal
    overlay?.addEventListener("click", function () {
        document.querySelectorAll("[id^='detailModal-']").forEach((modal) => {
            modal.classList.add("hidden");
        });
        overlay.classList.add("hidden");
    });

    // ===== Edit Modal =====
    document.querySelectorAll(".openEditModal").forEach((button) => {
        button.addEventListener("click", function () {
            // Mengambil ID task yang disimpan dalam atribut data-id
            const taskId = this.getAttribute("data-id");

            // Mencari modal yang sesuai berdasarkan ID task dan menghilangkan class 'hidden' untuk menampilkannya
            document
                .getElementById(`editTaskModal-${taskId}`)
                ?.classList.remove("hidden");
            overlay.classList.remove("hidden");
        });
    });

    // Ketika tombol dengan class closeEditModal diklik, modal akan ditutup
    document.querySelectorAll(".closeEditModal").forEach((button) => {
        button.addEventListener("click", function () {
            const taskId = this.getAttribute("data-id");
            document
                .getElementById(`editTaskModal-${taskId}`)
                ?.classList.add("hidden");
            overlay.classList.add("hidden");
        });
    });

    // ===== File Preview Modal =====
    const fileModal = document.getElementById("fileModal");
    const closeFileModal = document.getElementById("closeFileModal");
    const fileFrame = document.getElementById("fileFrame");
    const fileImage = document.getElementById("fileImage");
    const fileVideo = document.getElementById("fileVideo");
    const videoSource = document.getElementById("videoSource");
    const fileFallbackMessage = document.getElementById("fileFallbackMessage");
    const fileNameDisplay = document.getElementById("fileName");
    const uploadTimeDisplay = document.getElementById("uploadTime");
    const downloadButton = document.getElementById("downloadFile");

    document.querySelectorAll(".open-file-modal").forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            // Mengambil data file (URL, nama, dan waktu unggah) yang disimpan dalam atribut 'data-file'
            const fileData = JSON.parse(this.getAttribute("data-file"));
            const { url, name, uploaded_at } = fileData;

            // Memeriksa jenis file berdasarkan ekstensi nama file
            const isImage = /\.(jpg|jpeg|png|gif|webp)$/i.test(name);
            const isPDF = /\.pdf$/i.test(name);
            const isVideo = /\.(mp4|mov)$/i.test(name);

            // Menyembunyikan semua elemen file preview terlebih dahulu
            fileImage.classList.add("hidden");
            fileFrame.classList.add("hidden");
            fileVideo.classList.add("hidden");
            fileFallbackMessage.classList.add("hidden");

            // Menampilkan file sesuai dengan jenis file yang terdeteksi
            if (isImage) {
                fileImage.src = url;
                fileImage.classList.remove("hidden");
            } else if (isPDF) {
                fileFrame.src = url;
                fileFrame.classList.remove("hidden");
            } else if (isVideo) {
                videoSource.src = url;
                fileVideo.load();
                fileVideo.classList.remove("hidden");
            } else {
                fileFallbackMessage.classList.remove("hidden");
            }

            // Menampilkan nama file
            fileNameDisplay.textContent = name;

            // Menampilkan waktu unggah
            uploadTimeDisplay.textContent =
                "Added " +
                new Date(uploaded_at).toLocaleString("en-US", {
                    timeZone: "Asia/Jakarta",
                    year: "numeric",
                    month: "short",
                    day: "numeric",
                    hour: "numeric",
                    minute: "2-digit",
                    hour12: true,
                });

            // Tombol untuk mengunduh file
            downloadButton.href = url;
            downloadButton.download = name;
            downloadButton.classList.remove("hidden");

            fileModal.classList.remove("hidden");
        });
    });

    //  Menutup modal jika tombol close diklik
    closeFileModal?.addEventListener("click", function () {
        fileModal.classList.add("hidden");
        fileFrame.src = "";
        fileImage.src = "";
    });

    // ===== Delete Modal =====
    const deleteModal = document.getElementById("deleteModal");
    const cancelDelete = document.getElementById("cancelDelete");
    const deleteForm = document.getElementById("deleteForm");

    document.querySelectorAll(".openDeleteModal").forEach((button) => {
        button.addEventListener("click", function () {
            const taskId = button.closest(".card-task")?.dataset.taskId;

            // Jika ID tugas ditemukan, atur aksi form penghapusan untuk tugas tersebut
            if (taskId) {
                deleteForm.action = `/task/${taskId}`;
                deleteModal.classList.remove("hidden");
            }
        });
    });

    // Menambahkan event listener pada tombol batal untuk menutup modal tanpa melakukan penghapusan
    cancelDelete?.addEventListener("click", () => {
        deleteModal.classList.add("hidden");
    });

    // ===== Kategori Filter =====
    const showOpen = document.getElementById("showOpen");
    const showInProgress = document.getElementById("showInProgress");
    const showDone = document.getElementById("showDone");
    const openTasks = document.getElementById("openTasks");
    const inProgressTasks = document.getElementById("inProgressTasks");
    const doneTasks = document.getElementById("doneTasks");

    const buttons = [showOpen, showInProgress, showDone];

    // Fungsi untuk mengatur kelas aktif pada tombol kategori yang dipilih
    function setActiveButton(activeButton) {
        buttons.forEach((button) => {
            button?.classList.toggle("bg-blue-500", button === activeButton);
            button?.classList.toggle("text-white", button === activeButton);
            button?.classList.toggle("bg-white", button !== activeButton);
            button?.classList.toggle("text-blue-500", button !== activeButton);
        });
    }

    // Fungsi untuk menyembunyikan semua elemen tugas (Open, In Progress, Done)
    function hideAllTasks() {
        [openTasks, inProgressTasks, doneTasks].forEach((el) =>
            el?.classList.add("hidden")
        );
    }

    //  Menampilkan tugas kategori 'Open'
    showOpen?.addEventListener("click", () => {
        hideAllTasks();
        openTasks?.classList.remove("hidden");
        setActiveButton(showOpen);
    });

    //  Menampilkan tugas kategori 'In Progress'
    showInProgress?.addEventListener("click", () => {
        hideAllTasks();
        inProgressTasks?.classList.remove("hidden");
        setActiveButton(showInProgress);
    });

    //  Menampilkan tugas kategori 'Done'
    showDone?.addEventListener("click", () => {
        hideAllTasks();
        doneTasks?.classList.remove("hidden");
        setActiveButton(showDone);
    });

    // Memicu klik pada tombol 'Show Open' secara otomatis pada awal halaman dimuat
    showOpen?.click();

    // ===== Logout Modal =====
    const logoutModal = document.getElementById("logoutModal");
    const cancelLogout = document.getElementById("cancelLogout");

    // Menampilkan modal Logout
    document.querySelectorAll(".openLogoutModal").forEach((button) => {
        button.addEventListener("click", () => {
            logoutModal.classList.remove("hidden");
        });
    });

    // Menyembunyikan modal logout ketika
    cancelLogout?.addEventListener("click", () => {
        logoutModal.classList.add("hidden");
    });

    // ===== Burger Button =====
    const burgerBtn = document.getElementById("burgerBtn");
    const userMenu = document.getElementById("userMenu");

    burgerBtn?.addEventListener("click", () => {
        userMenu?.classList.toggle("hidden");
    });

    // ===== Password Validation =====
    const passwordInput = document.getElementById("password");
    const rulesList = document.getElementById("password-rules");

    const ruleLength = document.getElementById("rule-length");
    const ruleLetters = document.getElementById("rule-letters");
    const ruleMixed = document.getElementById("rule-mixed");
    const ruleNumbers = document.getElementById("rule-numbers");
    const ruleSymbols = document.getElementById("rule-symbols");

    // Fungsi untuk memperbarui status aturan validasi dengan memberikan warna hijau (valid) atau merah (tidak valid)
    function updateRule(element, condition) {
        // Menambahkan warna hijau jika kondisi terpenuhi (valid), dan merah jika tidak (tidak valid)
        element.classList.toggle("text-green-500", condition);
        element.classList.toggle("text-red-500", !condition);
    }

    // Menampilkan aturan validasi ketika pengguna mengklik input password
    passwordInput?.addEventListener("focus", () => {
        rulesList?.classList.replace("hidden", "block");
    });

    // Menyembunyikan aturan validasi ketika pengguna mengklik di luar input password
    passwordInput?.addEventListener("blur", () => {
        rulesList?.classList.replace("block", "hidden");
    });

    // Memantau inputan pengguna dan memvalidasi password dengan aturan tertentu
    passwordInput?.addEventListener("input", () => {
        const value = passwordInput.value;

        // Memperbarui status aturan dengan memeriksa kondisi password
        updateRule(ruleLength, value.length >= 8);
        updateRule(ruleLetters, /[a-zA-Z]/.test(value));
        updateRule(ruleMixed, /[a-z]/.test(value) && /[A-Z]/.test(value));
        updateRule(ruleNumbers, /\d/.test(value));
        updateRule(
            ruleSymbols,
            /[!@#$%^&*(),.?":{}|<>_\-+=~`[\]\\;]/.test(value)
        );
    });

    
});
