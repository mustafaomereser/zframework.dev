<script>
    modalTitle(currentModal, 'Yeni Konu Oluştur');
</script>
<div class="modal-body">
    <div class="auth-overlay" id="topicOverlay">
        <div class="auth-modal topic-modal-wide">
            <div class="auth-modal-body topic-modal-body-scroll">

                <!-- Başlık -->
                <div class="auth-field">
                    <label>Başlık <span style="color:var(--danger)">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-pen ai"></i>
                        <input class="form-control auth-input" type="text" id="topicTitle"
                            placeholder="Konunuzu özetleyen net bir başlık yazın..." maxlength="120" autocomplete="off">
                    </div>
                    <div class="topic-char-counter" id="topicTitleCounter">0 / 120</div>
                </div>

                <!-- İçerik -->
                <div class="auth-field">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:5px;">
                        <label style="margin:0;">İçerik <span style="color:var(--danger)">*</span></label>
                        <div class="topic-mode-toggle">
                            <button class="topic-mode-btn active" data-mode="write">Yaz</button>
                            <button class="topic-mode-btn" data-mode="preview">Önizle</button>
                        </div>
                    </div>
                    <div class="topic-toolbar">
                        <button type="button" class="topic-toolbar-btn" data-wrap="**,**"><i class="fas fa-bold"></i></button>
                        <button type="button" class="topic-toolbar-btn" data-wrap="*,*"><i class="fas fa-italic"></i></button>
                        <div class="topic-toolbar-sep"></div>
                        <button type="button" class="topic-toolbar-btn" data-wrap="`,`">&lt;/&gt;</button>
                        <button type="button" class="topic-toolbar-btn" data-wrap="&#96;&#96;&#96;&#10;,&#10;&#96;&#96;&#96;"><i class="fas fa-file-code"></i></button>
                        <div class="topic-toolbar-sep"></div>
                        <button type="button" class="topic-toolbar-btn" data-wrap="[,](url)"><i class="fas fa-link"></i></button>
                        <button type="button" class="topic-toolbar-btn" data-wrap="&gt; ,"><i class="fas fa-quote-right"></i></button>
                    </div>
                    <div id="topicEditorWrap">
                        <textarea class="topic-textarea" id="topicContent" maxlength="8000"
                            placeholder="Sorunuzu veya konunuzu detaylıca açıklayın..."></textarea>
                    </div>
                    <div class="topic-preview" id="topicPreview"></div>
                    <div class="topic-char-counter" id="topicContentCounter">0 / 8000</div>
                </div>

                <!-- Etiketler -->
                <div class="auth-field" style="margin-bottom:0;">
                    <label>Etiketler <span style="font-weight:400;color:var(--txt-muted);">(max 5, Enter ile ekle)</span></label>
                    <div class="topic-tags-wrap" id="topicTagsWrap">
                        <input type="text" class="topic-tags-input" id="topicTagsInput"
                            placeholder="Etiket yaz..." autocomplete="off">
                    </div>
                </div>

            </div>

            <div class="auth-modal-footer text-end mt-3">
                <button type="button" class="btn btn-sm btn-primary auth-submit" id="topicSubmitBtn">
                    <i class="fas fa-paper-plane me-1"></i> Yayınla
                </button>
            </div>
        </div>

    </div>
</div>
</div>


<script>
    $(() => {
        const topicModal = (() => {
            let tags = [];
            let previewing = false;

            function open() {
                $('#topicOverlay').addClass('open');
                $('body').css('overflow', 'hidden');
                clearAlert();
                setTimeout(() => $('#topicTitle').focus(), 150);
            }

            function close() {
                $('#topicOverlay').removeClass('open');
                $('body').css('overflow', '');
            }

            function showAlert(msg) {
                $.notify('danger').show(msg);
            }

            function clearAlert() {
                $('#topicAlert').attr('class', 'auth-alert-strip');
            }

            function addTag(val) {
                val = val.trim().toLowerCase().replace(/[^\w\-ğüşıöçĞÜŞİÖÇ]/g, '');
                if (!val || tags.includes(val) || tags.length >= 5) return;
                tags.push(val);
                renderTags();
            }

            function removeTag(val) {
                tags = tags.filter(t => t !== val);
                renderTags();
            }

            function renderTags() {
                $('#topicTagsWrap .topic-tag-chip').remove();
                tags.forEach(t => {
                    $(`<div class="topic-tag-chip">${t}<button type="button" class="topic-tag-remove" data-tag="${t}"><i class="fas fa-times"></i></button></div>`)
                        .prependTo('#topicTagsWrap');
                });
                $('#topicTagsInput')
                    .attr('placeholder', tags.length >= 5 ? '' : 'Etiket yaz...')
                    .prop('disabled', tags.length >= 5);
            }

            function updateCounter(val, max, $el) {
                const n = val.length;
                const cls = n > max - 20 ? ' over' : n > max - 80 ? ' warn' : '';
                $el.text(`${n} / ${max}`).attr('class', 'topic-char-counter' + cls);
            }

            function wrapText(before, after) {
                const el = document.getElementById('topicContent');
                const s = el.selectionStart,
                    e = el.selectionEnd;
                const sel = el.value.substring(s, e) || 'metin';
                el.value = el.value.substring(0, s) + before + sel + after + el.value.substring(e);
                el.selectionStart = s + before.length;
                el.selectionEnd = s + before.length + sel.length;
                $(el).trigger('input').focus();
            }

            function renderPreview(md) {
                if (!md.trim()) return '<span style="color:var(--txt-muted);font-style:italic;">Henüz içerik yok...</span>';
                return md
                    .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
                    .replace(/```([\s\S]*?)```/g, '<pre><code>$1</code></pre>')
                    .replace(/`([^`]+)`/g, '<code>$1</code>')
                    .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\*(.+?)\*/g, '<em>$1</em>')
                    .replace(/\n/g, '<br>');
            }

            function submit() {
                clearAlert();
                const title = $('#topicTitle').val().trim();
                const content = $('#topicContent').val().trim();

                if (!title) return showAlert('Başlık zorunludur.');
                if (title.length < 10) return showAlert('Başlık en az 10 karakter olmalı.');
                if (!content) return showAlert('İçerik zorunludur.');
                if (content.length < 20) return showAlert('İçerik en az 20 karakter olmalı.');

                const $btn = $('#topicSubmitBtn');
                $.core.btn.spin($btn);

                $.post('<?= route('topics.store') ?>', {
                        _token: csrf,
                        title,
                        category: `<?= request('c') ?>`,
                        content,
                        tags
                    })
                    .then(res => {
                        close();
                        zForum.toast.success('Konu başarıyla oluşturuldu!');
                        setTimeout(() => location.href = `<?= route('topics.show') ?>`.replace('{id}', res.topic), 600);
                    })
                    .catch(err => {
                        $.core.btn.unset($btn);
                        showAlert(err.responseJSON?.message || 'Bir hata oluştu, tekrar deneyin.');
                    });
            }

            function init() {
                $(document).on('click', '#topicModalClose, #topicCancelBtn', close);
                $(document).on('click', '#topicOverlay', function(e) {
                    if ($(e.target).is('#topicOverlay')) close();
                });

                $(document).on('input', '#topicTitle', function() {
                    updateCounter($(this).val(), 120, $('#topicTitleCounter'));
                });

                $(document).on('input', '#topicContent', function() {
                    updateCounter($(this).val(), 8000, $('#topicContentCounter'));
                    if (previewing) $('#topicPreview').html(renderPreview($(this).val()));
                });

                $(document).on('click', '.topic-toolbar-btn[data-wrap]', function() {
                    const parts = $(this).data('wrap').split(',');
                    wrapText(parts[0], parts[1] || '');
                });

                $(document).on('click', '.topic-mode-btn', function() {
                    previewing = $(this).data('mode') === 'preview';
                    $('.topic-mode-btn').removeClass('active');
                    $(this).addClass('active');
                    if (previewing) {
                        $('#topicEditorWrap').hide();
                        $('#topicPreview').html(renderPreview($('#topicContent').val())).addClass('show');
                    } else {
                        $('#topicEditorWrap').show();
                        $('#topicPreview').removeClass('show');
                        $('#topicContent').focus();
                    }
                });

                $(document).on('keydown', '#topicTagsInput', function(e) {
                    if (e.key === 'Enter' || e.key === ',') {
                        e.preventDefault();
                        addTag($(this).val());
                        $(this).val('');
                    }
                    if (e.key === 'Backspace' && !$(this).val() && tags.length) {
                        removeTag(tags[tags.length - 1]);
                    }
                });
                $(document).on('blur', '#topicTagsInput', function() {
                    if ($(this).val()) {
                        addTag($(this).val());
                        $(this).val('');
                    }
                });
                $(document).on('click', '#topicTagsWrap', () => $('#topicTagsInput').focus());
                $(document).on('click', '.topic-tag-remove', function(e) {
                    e.stopPropagation();
                    removeTag($(this).data('tag'));
                });

                $(document).on('click', '#topicSubmitBtn', submit);

                $(document).on('keydown', function(e) {
                    if (e.key === 'Escape' && $('#topicOverlay').hasClass('open')) close();
                    if ((e.ctrlKey || e.metaKey) && e.key === 'Enter' && $('#topicOverlay').hasClass('open')) submit();
                });
            }

            return {
                init,
                open,
                close
            };
        })();
        topicModal.init();
    });
</script>