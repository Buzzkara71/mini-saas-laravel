<x-app-modern title="Create Project">
    <div class="max-w-3xl glass-panel rounded-3xl p-8 md:p-10 card-hover">
        <div class="flex items-start justify-between gap-4 mb-6">
            <div>
                <p class="pill mb-2">New project</p>
                <h2 class="text-2xl font-bold">Spin up a fresh idea</h2>
                <p class="text-slate-300">Give your project a name and optional description.</p>
            </div>
            <a href="{{ route('app.projects.index') }}" class="soft-btn-secondary hidden sm:inline-flex">Back</a>
        </div>

        <form method="POST" action="{{ route('app.projects.store') }}" class="space-y-5">
            @csrf

            <label class="block">
                <span class="block text-sm text-slate-200 font-semibold mb-2">Project Name</span>
                <input type="text" name="name" required
                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-slate-400 focus:border-indigo-400 focus:ring-indigo-400">
            </label>

            <label class="block">
                <span class="block text-sm text-slate-200 font-semibold mb-2">Description</span>
                <textarea name="description" rows="4"
                          class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-slate-400 focus:border-indigo-400 focus:ring-indigo-400"></textarea>
            </label>

            <div class="flex flex-wrap gap-3">
                <button class="soft-btn-primary">Create Project</button>
                <a href="{{ route('app.projects.index') }}" class="soft-btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-app-modern>
