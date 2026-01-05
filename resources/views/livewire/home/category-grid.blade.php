<section class="bg-surface-dark py-12 border-t border-gray-800">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            
            @forelse($categories as $category)
            <a href="#" class="group block">
                <div class="aspect-[3/4] bg-gray-800 mb-4 overflow-hidden relative">
                    @if($category->image)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" 
                             alt="{{ $category->name }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 opacity-90 group-hover:opacity-100">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-700 text-gray-500">
                            <span class="material-icons-outlined text-4xl">image</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                </div>
                <h3 class="font-display font-medium text-lg uppercase tracking-wider text-text-dark group-hover:text-primary transition-colors">
                    {{ $category->name }}
                </h3>
            </a>
            @empty
                <!-- Empty State -->
                <div class="col-span-full py-12 text-gray-400">
                    No categories found.
                </div>
            @endforelse

        </div>
    </div>
</section>
