<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  @vite('resources/css/app.css')
  <title>MyPortofolio</title>
</head>

<body>
  <div class="navbar bg-base-100">
    <div class="flex-1">
      <a href="/" class="btn btn-ghost normal-case text-xl">MyPortofolio</a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1">
        <li><a href="#about">About</a></li>
        <li><a href="#project">Project</a></li>
      </ul>
    </div>
  </div>

  <div id="home" class="hero min-h-screen bg-base-100">
    <div class="hero-content flex-col lg:flex-row">
      <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
        class="max-w-sm rounded-lg shadow-2xl" />
      <div>
        <h1 class="text-5xl font-bold">Your Name</h1>
        <p class="py-6">Lorem ipsum dolor, sit amet consectetur adipisicing elit. At ullam aut explicabo est esse,
          delectus reiciendis amet molestias a accusamus, cumque dignissimos, ad ut eveniet molestiae animi odit.
          Suscipit, error!</p>
        <a href="#about" class="btn btn-primary">About Me</a>
      </div>
    </div>
  </div>

  <div id="about" class="hero min-h-screen bg-base-300">
    <div class="hero-content text-center">
      <div class="max-w-md">
        <h1 class="text-5xl font-bold">About Me</h1>
        <p class="py-6">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe rem, error recusandae illo, itaque architecto,
          laudantium provident assumenda sit perspiciatis sequi unde magnam qui. A obcaecati fuga fugit suscipit
          mollitia.
        </p>
        <a href="# target="_blank" class="btn btn-info btn-outline">Download CV</a>
      </div>
    </div>
  </div>

  <div id="project" class="min-h-screen bg-base-100 py-12">
    <h1 class="text-5xl font-bold text-center mb-12">Projects</h1>
    <div id="projects-container"
      class="flex justify-center flex-col lg:flex-row lg:flex-wrap lg:items-stretch items-center gap-8">
      @foreach ($projects as $project)
        <div class="card w-full lg:w-96 bg-base-100 shadow-xl">
          <figure>
            <img src="{{ Storage::url($project->image) }}" alt="{{ $project->name_project }}" class="rounded-t-lg" />
          </figure>
          <div class="card-body">
            <h2 class="card-title">{{ $project->name_project }}</h2>
            <p>{{ $project->description }}</p>

            <div class="card-actions justify-end">
              @if ($project->demo !== null)
                <a target="_blank" href="{{ $project->demo }}" class="btn btn-primary">View Demo</a>
              @endif
              @if ($project->github !== null)
                <a target="_blank" href="{{ $project->github }}" class="btn btn-secondary">View Code</a>
              @endif
            </div>

          </div>
        </div>
      @endforeach
    </div>
    <div id="project-pagination" class="flex justify-center mt-12">
      {{ $projects->links() }}
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const projectPagination = document.getElementById('project-pagination');

      if (projectPagination) {
        projectPagination.addEventListener('click', (e) => {
          if (e.target.tagName === 'A') {
            e.preventDefault();
            const url = e.target.href;

            fetch(url, {
                headers: {
                  'X-Requested-With': 'XMLHttpRequest'
                }
              })
              .then(response => response.text())
              .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newProjects = doc.querySelector('#projects-container').innerHTML;
                const newPagination = doc.querySelector('#project-pagination').innerHTML;

                document.querySelector('#projects-container').innerHTML = newProjects;
                document.querySelector('#project-pagination').innerHTML = newPagination;

                window.scrollTo({
                  top: document.querySelector('#project').offsetTop,
                  behavior: 'smooth'
                });
              });
          }
        });
      }
    });
  </script>
</body>

</html>
