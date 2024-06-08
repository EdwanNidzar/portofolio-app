<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Projects') }}
    </h2>
  </x-slot>

  @if (session()->has('success'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="alert alert-success" id="success-alert">
        {{ session()->get('success') }}
      </div>
    </div>
  @endif

  @if (session()->has('error'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="alert alert-danger" id="error-alert">
        {{ session()->get('error') }}
      </div>
    </div>
  @endif

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="overflow-hidden overflow-x-auto">
            <div class="flex justify-between items-center mb-6">
              <h1 class="text-2xl font-semibold">Data Projects</h1>
              <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a>
            </div>
            <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                        Project</th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created
                        At</th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated
                        At</th>
                      <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach ($projects as $project)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                              <img class="h-10 w-10 rounded-full" src="{{ Storage::url($project->image) }}"
                                alt="{{ $project->name_project }}">
                            </div>
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $project->name_project }}</div>
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-gray-900 dark:text-gray-100">{{ $project->created_at }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-gray-900 dark:text-gray-100">{{ $project->updated_at }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                          <div class="flex justify-end space-x-2">
                            <a href="{{ route('projects.show', $project->id) }}"
                              class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">Show</a>
                            <a href="{{ route('projects.edit', $project->id) }}"
                              class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-600">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this project?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit"
                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">Delete</button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="px-4 py-3 border-t sm:px-6">
                  {{ $projects->links() }}
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

<script>
  // Menghilangkan alert dalam 5 detik
  document.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(() => {
      let successAlert = document.getElementById('success-alert');
      if (successAlert) {
        successAlert.style.display = 'none';
      }

      let errorAlert = document.getElementById('error-alert');
      if (errorAlert) {
        errorAlert.style.display = 'none';
      }
    }, 5000);
  });
</script>
