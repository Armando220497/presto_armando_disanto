<div>
    @if (session()->has('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form class="bg-body-custom shadow rounded p-5 my-5" wire:submit.prevent="store">
        <div class="mb-3">
            <label for="title" class="form-label ">{{ __('ui.title') }}</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                wire:model="title">
            @error('title')
                <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">{{ __('ui.description') }}</label>
            <textarea id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror"
                wire:model="description"></textarea>
            @error('description')
                <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">{{ __('ui.price') }}</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                wire:model="price">
            @error('price')
                <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">{{ __('ui.select_category') }}</label>
            <select id="category" wire:model="category" class="form-control @error('category') is-invalid @enderror">
                <option value="" disabled selected>{{ __('ui.select_category') }}</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->translated_name }}</option>
                @endforeach
            </select>
            
            </select>
            @error('category')
                <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror
            
        </div>

        <div class="mb-3">
            <label for="temporary_images" class="form-label">{{ __('ui.upload_images') }}</label>
            <input type="file" wire:model.live="temporary_images" multiple
                class="form-control @error('temporary_images') is-invalid @enderror" id="temporary_images" />
            @error('temporary_images')
                <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror

            @if (!empty($images))
                <div class="row">
                    <p>{{ __('ui.image_preview') }}</p>
                    <div class="row border border-4 border-light rounded shadow py-4">
                        @foreach ($images as $key => $image)
                            <div class="col-12 flex-column align-items-center my-3">
                                <div class="img-preview mx-auto shadow rounded"
                                    style="background-image: url('{{ $image->temporaryUrl() }}');">
                                </div>
                                <button type="button" class="btn mt-1 btn-danger"
                                    wire:click="removeImage({{ $key }})">X</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center">
            <button style="background-color: #EE922B; border: none; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" type="submit" class="btn btn-primary">{{ __('ui.create') }}</button>
        </div>
    </form>
</div>
