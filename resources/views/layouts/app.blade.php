<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .ProseMirror:focus {
            outline: none;
        }

        .tiptap ul p,
        .tiptap ol p {
            display: inline;
        }

        [data-hs-file-upload-preview] img {
            width: 500px;
            height: 500px;
            object-fit: cover;
        }
    </style>
</head>

<body class="font-sans antialiased">
    {{-- <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div> --}}

    @include('components.sidebar')
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<script>
    (function() {
  const { element } = HSFileUpload.getInstance('#hs-file-upload-with-limited-file-size', true);

  element.dropzone.options.maxFiles = 1;

  element.dropzone.on("addedfile", function(file) {
    const errorMessage = document.getElementById("upload-error");

    // Hapus file sebelumnya jika ada file baru yang diunggah
    if (element.dropzone.files.length > 1) {
      element.dropzone.removeFile(element.dropzone.files[0]);
    }

    // Validasi ukuran file (2MB)
    if (file.size > element.concatOptions.maxFilesize * 1024 * 1024) {
      element.dropzone.removeFile(file);
      errorMessage.textContent = "Ukuran file terlalu besar! Maksimum 2MB.";
      errorMessage.classList.remove("hidden");
    } else {
      errorMessage.classList.add("hidden");
    }
  });

  element.dropzone.on("error", function(file, response) {
    const errorMessage = document.getElementById("upload-error");

    // Hapus file jika terjadi error
    element.dropzone.removeFile(file);

    // Tampilkan pesan error
    errorMessage.textContent = "File tidak valid! Harap unggah gambar dengan ukuran maksimal 2MB.";
    errorMessage.classList.remove("hidden");
  });

})();
</script>

<script type="importmap">
    {
    "imports": {
      "https://esm.sh/v135/prosemirror-model@1.19.3/es2022/prosemirror-model.mjs": "https://esm.sh/v135/prosemirror-model@1.20.0/es2022/prosemirror-model.mjs",
      "https://esm.sh/v135/prosemirror-model@1.19.4/es2022/prosemirror-model.mjs": "https://esm.sh/v135/prosemirror-model@1.20.0/es2022/prosemirror-model.mjs",
      "https://esm.sh/v135/prosemirror-model@1.20.0/es2022/prosemirror-model.mjs": "https://esm.sh/v135/prosemirror-model@1.20.0/es2022/prosemirror-model.mjs",
      "https://esm.sh/v135/prosemirror-model@1.21.0/es2022/prosemirror-model.mjs": "https://esm.sh/v135/prosemirror-model@1.20.0/es2022/prosemirror-model.mjs",
      "https://esm.sh/v135/prosemirror-model@1.22.1/es2022/prosemirror-model.mjs": "https://esm.sh/v135/prosemirror-model@1.20.0/es2022/prosemirror-model.mjs",
      "https://esm.sh/v135/prosemirror-model@1.23.0/es2022/prosemirror-model.mjs": "https://esm.sh/v135/prosemirror-model@1.20.0/es2022/prosemirror-model.mjs"
    }
  }
</script>

<script type="module">
    import { Editor } from 'https://esm.sh/@tiptap/core';
  import StarterKit from 'https://esm.sh/@tiptap/starter-kit';
  import Placeholder from 'https://esm.sh/@tiptap/extension-placeholder';
  import Paragraph from 'https://esm.sh/@tiptap/extension-paragraph';
  import Bold from 'https://esm.sh/@tiptap/extension-bold';
  import Underline from 'https://esm.sh/@tiptap/extension-underline';
  import Link from 'https://esm.sh/@tiptap/extension-link';
  import BulletList from 'https://esm.sh/@tiptap/extension-bullet-list';
  import OrderedList from 'https://esm.sh/@tiptap/extension-ordered-list';
  import ListItem from 'https://esm.sh/@tiptap/extension-list-item';
  import Blockquote from 'https://esm.sh/@tiptap/extension-blockquote';

  const editor = new Editor({
    element: document.querySelector('#hs-editor-tiptap [data-hs-editor-field]'),
    editorProps: {
      attributes: {
        class: 'relative min-h-40 p-3'
      }
    },
    extensions: [
      StarterKit.configure({
        history: false
      }),
      Placeholder.configure({
        placeholder: 'Add a message, if you\'d like.',
        emptyNodeClass: 'before:text-gray-500'
      }),
      Paragraph.configure({
        HTMLAttributes: {
          class: 'text-inherit text-gray-800 dark:text-neutral-200'
        }
      }),
      Bold.configure({
        HTMLAttributes: {
          class: 'font-bold'
        }
      }),
      Underline,
      Link.configure({
        HTMLAttributes: {
          class: 'inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-white'
        }
      }),
      BulletList.configure({
        HTMLAttributes: {
          class: 'list-disc list-inside text-gray-800 dark:text-white'
        }
      }),
      OrderedList.configure({
        HTMLAttributes: {
          class: 'list-decimal list-inside text-gray-800 dark:text-white'
        }
      }),
      ListItem.configure({
        HTMLAttributes: {
          class: 'marker:text-sm'
        }
      }),
      Blockquote.configure({
        HTMLAttributes: {
          class: 'relative border-s-4 ps-4 sm:ps-6 dark:border-neutral-700 [&>p]:sm:text-lg'
        }
      })
    ]
  });
  const actions = [
    {
      id: '#hs-editor-tiptap [data-hs-editor-bold]',
      fn: () => editor.chain().focus().toggleBold().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-italic]',
      fn: () => editor.chain().focus().toggleItalic().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-underline]',
      fn: () => editor.chain().focus().toggleUnderline().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-strike]',
      fn: () => editor.chain().focus().toggleStrike().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-link]',
      fn: () => {
        const url = window.prompt('URL');
        editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
      }
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-ol]',
      fn: () => editor.chain().focus().toggleOrderedList().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-ul]',
      fn: () => editor.chain().focus().toggleBulletList().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-blockquote]',
      fn: () => editor.chain().focus().toggleBlockquote().run()
    },
    {
      id: '#hs-editor-tiptap [data-hs-editor-code]',
      fn: () => editor.chain().focus().toggleCode().run()
    }
  ];

  actions.forEach(({ id, fn }) => {
    const action = document.querySelector(id);

    if (action === null) return;

    action.addEventListener('click', fn);
  });
</script>

</html>