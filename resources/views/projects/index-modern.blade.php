<x-app-modern title="Projects">
    <div class="space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="pill mb-2">Projects</p>
                <h2 class="text-2xl font-bold">Your workspaces</h2>
                <p class="text-slate-300">A quick glance at everything you’re building.</p>
            </div>
            <a href="{{ route('app.projects.create') }}" class="soft-btn-primary">
                + New Project
            </a>
        </div>

        @if ($projects->isEmpty())
            <div class="glass-panel rounded-2xl p-8 text-center card-hover">
                <p class="text-lg font-semibold">No projects yet</p>
                <p class="text-slate-300 mt-2">Start your first project to see it appear here.</p>
                <a href="{{ route('app.projects.create') }}" class="soft-btn-primary mt-4 inline-flex">
                    Create one now
                </a>
            </div>
        @else
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                @foreach ($projects as $project)
                    <div class="glass-panel rounded-2xl p-5 card-hover">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm text-slate-300">Created {{ $project->created_at->format('d M Y') }}</p>
                                <h3 class="text-xl font-semibold mt-1">{{ $project->name }}</h3>
                            </div>
                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        </div>
                        @if($project->description)
                            <p class="text-slate-300 mt-3 text-sm leading-relaxed">{{ $project->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-modern>
