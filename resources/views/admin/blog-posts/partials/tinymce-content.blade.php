{{-- TinyMCE 6 (free, self-hosted via jsDelivr) for Contenu field --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var contentTextarea = document.getElementById('content');
    if (!contentTextarea || typeof tinymce === 'undefined') return;

    var form = contentTextarea.closest('form');

    tinymce.init({
        selector: '#content',
        base_url: 'https://cdn.jsdelivr.net/npm/tinymce@6.8.2/',
        height: 400,
        menubar: false,
        plugins: 'lists link image table code',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image | removeformat code',
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4',
        content_style: 'body { font-family: inherit; font-size: 14px; }',
        branding: false,
        promotion: false
    });

    if (form) {
        form.addEventListener('submit', function() {
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
            }
        });
    }
});
</script>
@endpush
