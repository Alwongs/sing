<li class="settings-dir-files-list">
    <h3 class="settings-dir-files-list__title">
        {{ $title }}
    </h3>

    <ul class="settings-file-list">
        @foreach($files as $file)
            <li class="settings-file-list__item">
                <code>storage/app/public/{{ $file }}</code>
            </li>
        @endforeach
    </ul>
</li>