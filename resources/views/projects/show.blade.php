<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Show Project') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
              <label for="name_project" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Project
                Name</label>
              <input readonly name="name_project" type="text" value="{{ $project->name_project }}"
                placeholder="Project Name" class="input input-bordered w-full" />
            </div>

            <div class="mb-4">
              <label for="description"
                class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
              <textarea readonly name="description" class="textarea textarea-bordered w-full" placeholder="Description">{{ $project->description }}</textarea>
            </div>

            <div class="mb-4">
              <label for="demo" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Link
                Demo</label>
              <input readonly name="demo" type="text" value="{{ $project->demo }}" placeholder="Link Demo"
                class="input input-bordered w-full" />
            </div>

            <div class="mb-4">
              <label for="github" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Link
                Github</label>
              <input readonly name="github" type="text" value="{{ $project->github }}" placeholder="Link Github"
                class="input input-bordered w-full" />
            </div>

            <div class="mb-4" x-data="{ avatarPreview: '{{ $project->image ? Storage::url($project->image) : '' }}' }">
              <label for="github" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Project
                Cover</label>
              <template x-if="avatarPreview">
                <div class="mt-2">
                  <img :src="avatarPreview" class="h-28 w-28 object-cover">
                </div>
              </template>
              
            </div>

            <div class="mb-4">
              <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-outline">Back</a>
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
