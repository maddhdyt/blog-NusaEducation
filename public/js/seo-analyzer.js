document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const metaDescInput = document.getElementById('meta_description');
    const keywordInput = document.getElementById('focus_keyword');
    const contentInput = document.getElementById('content'); // Gets updated by Quill

    const previewUrl = document.getElementById('seo-preview-url');
    const previewTitle = document.getElementById('seo-preview-title');
    const previewDesc = document.getElementById('seo-preview-desc');
    const checklist = document.getElementById('seo-checklist');

    const domain = window.location.origin;

    function stripHtml(html) {
        let tmp = document.createElement("DIV");
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || "";
    }

    function createBadge(color) {
        const icons = {
            'red': '<svg style="width:20px;height:20px;flex-shrink:0;color:#ef4444" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            'orange': '<svg style="width:20px;height:20px;flex-shrink:0;color:#f97316" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
            'green': '<svg style="width:20px;height:20px;flex-shrink:0;color:#22c55e" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            'gray': '<svg style="width:20px;height:20px;flex-shrink:0;color:#9ca3af" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
        };
        return icons[color];
    }

    function analyze() {
        const title = titleInput.value.trim();
        const slug = slugInput.value.trim() || title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        const metaDesc = metaDescInput.value.trim();
        const keyword = keywordInput.value.trim().toLowerCase();
        
        // Ensure content is fresh from quill if available
        let contentHtml = '';
        if (typeof quill !== 'undefined') {
            contentHtml = quill.root.innerHTML;
        } else {
            contentHtml = contentInput.value;
        }
        
        const contentText = stripHtml(contentHtml).trim();
        const wordCount = contentText ? contentText.split(/\s+/).length : 0;

        // --- Update Preview ---
        previewUrl.textContent = `${domain}/${slug}`;
        previewTitle.textContent = title ? `${title} - Nusa Education` : 'Judul Postingan Akan Muncul Di Sini - Nusa Education';
        previewDesc.textContent = metaDesc ? metaDesc : 'Deskripsi meta belum diisi. Masukkan deskripsi meta agar muncul di hasil pencarian Google dengan rapi.';

        // --- Check conditions ---
        let results = [];

        // 1. Keyword check
        if (!keyword) {
            results.push({ color: 'gray', text: 'Masukkan Focus Keyword untuk memulai analisis.' });
            checklist.innerHTML = results.map(r => `<li class="flex items-start gap-2 text-sm text-gray-700">${createBadge(r.color)} <span>${r.text}</span></li>`).join('');
            return;
        }

        // Title Length
        if (title.length === 0) {
            results.push({ color: 'red', text: 'Judul masih kosong.' });
        } else if (title.length < 30) {
            results.push({ color: 'orange', text: `Judul terlalu pendek (${title.length} karakter). Idealnya 50-60 karakter.` });
        } else if (title.length > 60) {
            results.push({ color: 'orange', text: `Judul terlalu panjang (${title.length} karakter). Idealnya 50-60 karakter.` });
        } else {
            results.push({ color: 'green', text: `Panjang judul sangat baik (${title.length} karakter).` });
        }

        // Keyword in Title
        if (title.toLowerCase().includes(keyword)) {
            if (title.toLowerCase().startsWith(keyword)) {
                results.push({ color: 'green', text: 'Focus Keyword muncul di awal judul. Sempurna!' });
            } else {
                results.push({ color: 'green', text: 'Focus Keyword ditemukan di dalam judul.' });
            }
        } else {
            results.push({ color: 'red', text: 'Focus Keyword tidak ditemukan di judul.' });
        }

        // Meta Desc Length
        if (metaDesc.length === 0) {
            results.push({ color: 'red', text: 'Meta Description masih kosong.' });
        } else if (metaDesc.length < 120) {
            results.push({ color: 'orange', text: `Meta Description terlalu pendek (${metaDesc.length} karakter). Idealnya 120-156 karakter.` });
        } else if (metaDesc.length > 156) {
            results.push({ color: 'orange', text: `Meta Description terlalu panjang (${metaDesc.length} karakter). Idealnya 120-156 karakter.` });
        } else {
            results.push({ color: 'green', text: `Panjang Meta Description sangat baik (${metaDesc.length} karakter).` });
        }

        // Keyword in Meta Desc
        if (metaDesc.toLowerCase().includes(keyword)) {
            results.push({ color: 'green', text: 'Focus Keyword ditemukan di Meta Description.' });
        } else {
            results.push({ color: 'red', text: 'Focus Keyword tidak ditemukan di Meta Description.' });
        }

        // Content Length
        if (wordCount === 0) {
            results.push({ color: 'red', text: 'Konten artikel masih kosong.' });
        } else if (wordCount < 300) {
            results.push({ color: 'orange', text: `Konten artikel terlalu pendek (${wordCount} kata). Disarankan minimal 300 kata.` });
        } else {
            results.push({ color: 'green', text: `Panjang konten memadai (${wordCount} kata).` });
        }

        // Keyword Density
        const keywordRegex = new RegExp(keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'gi');
        const keywordMatches = contentText.match(keywordRegex);
        const keywordCount = keywordMatches ? keywordMatches.length : 0;
        
        if (wordCount > 0) {
            const density = ((keywordCount / wordCount) * 100).toFixed(1);
            if (keywordCount === 0) {
                results.push({ color: 'red', text: 'Focus Keyword tidak ditemukan di dalam isi konten.' });
            } else if (density < 0.5) {
                results.push({ color: 'orange', text: `Kepadatan keyword terlalu rendah (${density}%). Coba tambahkan keyword ke dalam tulisan.` });
            } else if (density > 2.5) {
                results.push({ color: 'red', text: `Kepadatan keyword terlalu tinggi (${density}%). Hati-hati terkena penalti Google (Keyword Stuffing).` });
            } else {
                results.push({ color: 'green', text: `Kepadatan keyword sangat baik (${density}%, muncul ${keywordCount} kali).` });
            }
        }

        // Render checklist (sort: red first, then orange, then green)
        const order = { 'red': 1, 'orange': 2, 'green': 3 };
        results.sort((a, b) => order[a.color] - order[b.color]);

        checklist.innerHTML = results.map(r => `<li class="flex items-start gap-2 text-sm text-gray-700">${createBadge(r.color)} <span>${r.text}</span></li>`).join('');
    }

    // Event listeners
    titleInput.addEventListener('input', analyze);
    slugInput.addEventListener('input', analyze);
    metaDescInput.addEventListener('input', analyze);
    keywordInput.addEventListener('input', analyze);

    // Quill editor listener
    if (typeof quill !== 'undefined') {
        quill.on('text-change', analyze);
    }

    // Initial run
    analyze();
});
