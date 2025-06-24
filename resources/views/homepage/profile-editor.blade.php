<div class="w-full px-4 pt-6">
    <div class="grid grid-cols-12 gap-6">

        <!-- Avatar -->
        <div class="col-span-2 flex justify-center">
            <div class="bg-white p-4 rounded shadow aspect-square flex items-center justify-center">
                <img src="https://via.placeholder.com/32x32?text=Avatar" class="rounded-full w-32 h-32 object-cover">
            </div>
        </div>

        <!-- edit -->
        <div class="col-span-10">
            <div class="bg-white p-6 rounded shadow space-y-4">
                <form method="POST" action="blog/store" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- text -->
                    <textarea name="content" placeholder="Write something..." class="textarea textarea-bordered w-full resize-none" rows="4"></textarea>

                    <!-- img-preview -->
                    <div id="preview-wrapper" class="hidden relative w-fit">
                        <img id="preview" src="#" class="rounded-lg shadow w-48 h-auto">
                        <button type="button" onclick="removeImage()" class="btn btn-xs btn-circle btn-error absolute top-0 right-0 translate-x-1/2 translate-y-1/2">✖</button>
                    </div>
                    
                    <div class="flex gap-4 items-center">
                        <!-- img-upload -->
                        <div id="upload-section">
                            <label for="image" id="upload-label" class="btn btn-outline btn-sm cursor-pointer">
                                Add img
                            </label>
                            <input id="image" name="image" type="file" accept="image/*" class="hidden" onchange="previewImage(this)">
                        </div>

                        <!-- submit -->
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>