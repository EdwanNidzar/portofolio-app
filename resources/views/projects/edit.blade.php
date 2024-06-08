<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Edit Project') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <label for="name_project" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Project
                Name</label>
              <input name="name_project" type="text" placeholder="Project Name" class="input input-bordered w-full"
                value="{{ $project->name_project }}" />
            </div>
            @error('name_project')
              <div class="alert alert-error">
                <span>{{ $message }}</span>
              </div>
            @enderror

            <div class="mb-4">
              <label for="description"
                class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
              <textarea name="description" class="textarea textarea-bordered w-full" placeholder="Description">{{ $project->description }}</textarea>
            </div>
            @error('description')
              <div class="alert alert-error">
                <span>{{ $message }}</span>
              </div>
            @enderror

            <div class="mb-4">
              <label for="demo" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Link
                Demo</label>
              <input name="demo" type="text" placeholder="Masukan Link Demo Jika Ada"
                class="input input-bordered w-full" value="{{ $project->demo }}" />
            </div>
            @error('demo')
              <div class="alert alert-error">
                <span>{{ $message }}</span>
              </div>
            @enderror

            <div class="mb-4">
              <label for="github" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Link
                Github</label>
              <input name="github" type="text" placeholder="Masukan Link Github Jika Ada"
                class="input input-bordered w-full" value="{{ $project->github }}" />
            </div>
            @error('github')
              <div class="alert alert-error">
                <span>{{ $message }}</span>
              </div>
            @enderror

            <div class="mb-4" x-data="{ avatarPreview: '{{ $project->image ? Storage::url($project->image) : '' }}' }">
              <label for="github" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Project
                Cover</label>
              <input name="image" type="file" class="file-input file-input-bordered w-full max-w-xs"
                x-on:change="fileChosen">
              <template x-if="avatarPreview">
                <div class="mt-2">
                  <img x-bind:src="avatarPreview" class="h-28 w-h-28 object-cover">
                </div>
              </template>
            </div>
            @error('image')
              <div class="alert alert-error">
                <span>{{ $message }}</span>
              </div>
            @enderror

            <div class="mb-4">
              <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Project
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

<script>
  function fileChosen(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.avatarPreview = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  }
</script>
