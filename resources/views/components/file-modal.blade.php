<div id="fileModal" class="fixed hidden z-[999] top-0 left-0 w-full h-screen bg-black bg-opacity-70">
    <div class="flex flex-col p-4 items-center justify-between relative h-full w-full">

        <!-- Tombol untuk menutup modal -->
        <button id="closeFileModal" class="self-end text-gray-500 hover:text-gray-200 font-bold text-3xl md:text-4xl">
            &times;
        </button>

        <!-- Tampilan gambar jika file adalah gambar -->
        <img id="fileImage" class="max-w-full max-h-[60vh]  hidden rounded shadow-md" />

        <!-- Tampilan iframe jika file adalah dokumen (misalnya PDF) -->
        <iframe id="fileFrame" class="w-full h-full hidden rounded shadow-md"></iframe>

        <!-- Tampilan video jika file adalah video -->
        <video id="fileVideo" class="max-w-full max-h-[60vh] hidden rounded shadow-md" controls>
            <source id="videoSource" src="" type="video/mp4" />
            Your browser does not support the video tag.
        </video>

        <!-- Pesan jika file tidak dapat dipratinjau -->
        <div id="fileFallbackMessage" class="hidden text-white text-center mt-4">
            <p class="text-xl font-semibold">There is no preview available for this attachment.</p>
            <p class="text-sm">Please download to view the content of the file.</p>
        </div>

        <!-- Informasi file dan link download -->
        <div class="flex flex-col justify-center gap-y-2 text-center mt-10">
            <h1 id="fileName" class="text-lg md:text-2xl text-white font-bold"></h1>
            <p id="uploadTime" class="text-sm  text-white font-light"></p>
            <a id="downloadFile" href="#" class="text-sm text-white font-light">
                Download File
            </a>
        </div>
    </div>
</div>
