<div>
    <button wire:click="remove()" class="text-red-500 flex-center cursor-pointer">
        Hapus
        <div wire:loading class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-blue rounded-full dark:text-blue" role="status" aria-label="loading">
            <span class="sr-only">Loading...</span>
          </div>
    </button>
</div>
