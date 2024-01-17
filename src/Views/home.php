<div class="text-center my-5">
    <h1>Welcome to the Home Page</h1>
    <p>This is the home page content.</p>
</div>
<div class="row justify-content-center">
    <div class="col-4">
        <form action="upload-json" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Your Data</label>
                <input class="form-control" name="data" type="file" id="formFile">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-dark">Upload</button>
            </div>
        </form>
    </div>
</div>
