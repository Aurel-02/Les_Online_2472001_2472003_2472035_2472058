<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </div>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ══ MAIN CONTENT ══ -->
    <main class="main-wrapper">

        <!-- ── CHAT BODY ── -->
        <div class="content-body">
            <div class="chat-container">
                <!-- ── CHAT SIDEBAR ── -->
                <div class="chat-sidebar">
                    <div class="chat-sidebar-header">
                        <h3>Pesan</h3>
                        <div class="search-container">
                            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            <input type="text" id="search-contact" placeholder="Cari guru...">
                        </div>
                    </div>
                    
                    <div class="contact-list" id="contacts-container">
                        <!-- Contacts loaded dynamically -->
                        <div style="padding: 24px; text-align: center; color: rgba(61,43,31,0.5);">
                            Memuat kontak...
                        </div>
                    </div>
                </div>

                <!-- ── CHAT MAIN AREA ── -->
                <div class="chat-main" id="chat-main-area" style="display: none;">
                    <div class="chat-header">
                        <div class="active-chat-info">
                            <div class="contact-avatar" id="active-avatar" style="background: var(--dusty-mauve);">
                                BD
                            </div>
                            <div>
                                <div class="active-chat-name" id="active-name">Budi Darmawan</div>
                                <div class="active-chat-status">Online</div>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <button class="btn-attachment" style="border: none; background: transparent;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                            </button>
                        </div>
                    </div>

                    <div class="chat-messages" id="chat-messages">
                        <!-- Messages loaded dynamically -->
                    </div>

                    <div class="chat-input-area">
                        <button class="btn-attachment">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                        </button>
                        <div class="input-wrapper">
                            <input type="text" id="message-input" placeholder="Ketik pesan di sini..." autocomplete="off">
                        </div>
                        <button class="btn-send" id="btn-send">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </button>
                    </div>
                </div>
        document.addEventListener('DOMContentLoaded', function() {
            const contactsContainer = document.getElementById('contacts-container');
            const chatMainArea = document.getElementById('chat-main-area');
            const chatEmptyState = document.getElementById('chat-empty-state');
            const activeName = document.getElementById('active-name');
            const activeAvatar = document.getElementById('active-avatar');
            const chatMessages = document.getElementById('chat-messages');
            const messageInput = document.getElementById('message-input');
            const btnSend = document.getElementById('btn-send');
            const searchContact = document.getElementById('search-contact');

            let activeContactId = null;
            let pollingInterval = null;
            let allContacts = [];

            // Get CSRF Token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Load Contacts
            function loadContacts(selectedId = null) {
                fetch('{{ route("chat.contacts") }}')
                    .then(response => response.json())
                    .then(data => {
                        allContacts = data;
                        renderContacts(allContacts, selectedId);
                    })
                    .catch(err => {
                        console.error('Error fetching contacts:', err);
                        contactsContainer.innerHTML = '<div style="padding:24px;text-align:center;color:red;">Gagal memuat kontak.</div>';
                    });
            }

            // Render Contacts List
            function renderContacts(contacts, selectedId = null) {
                if (contacts.length === 0) {
                    contactsContainer.innerHTML = '<div style="padding:24px;text-align:center;color:rgba(61,43,31,0.5);">Tidak ada kontak.</div>';
                    return;
                }

                contactsContainer.innerHTML = '';
                contacts.forEach(contact => {
                    const initials = contact.nama.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                    const activeClass = (selectedId == contact.id_user || activeContactId == contact.id_user) ? 'active' : '';
                    
                    const avatarContent = contact.photo_profile 
                        ? `<img src="/uploads/profiles/${contact.photo_profile}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;" />`
                        : initials;

                    const unreadBadge = contact.unread_count > 0 
                        ? `<span class="unread-badge">${contact.unread_count}</span>` 
                        : '';

                    const lastMessageText = contact.last_message ? contact.last_message : 'Belum ada pesan';
                    const lastMessageTime = contact.last_time ? contact.last_time : '';

                    const itemHtml = `
                        <div class="contact-item ${activeClass}" data-id="${contact.id_user}" data-name="${contact.nama}">
                            <div class="contact-avatar" style="background: var(--dusty-mauve);">
                                ${avatarContent}
                                <div class="status-dot"></div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">${contact.nama}</div>
                                <div class="contact-subject" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${lastMessageText}</div>
                            </div>
                            <div class="contact-meta">
                                <span class="contact-time">${lastMessageTime}</span>
                                ${unreadBadge}
                            </div>
                        </div>
                    `;
                    contactsContainer.insertAdjacentHTML('beforeend', itemHtml);
                });

                // Attach Event Listeners to contact items
                document.querySelectorAll('.contact-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const name = this.getAttribute('data-name');
                        selectContact(id, name);
                    });
                });
            }

            // Filter Contacts locally
            searchContact.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                const filtered = allContacts.filter(c => c.nama.toLowerCase().includes(query));
                renderContacts(filtered);
            });

            // Select Contact to Chat
            function selectContact(id, name) {
                activeContactId = id;
                
                // Update UI active states
                document.querySelectorAll('.contact-item').forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('data-id') == id) {
                        item.classList.add('active');
                    }
                });

                // Set header details
                activeName.textContent = name;
                const initials = name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                
                const matchedContact = allContacts.find(c => c.id_user == id);
                if (matchedContact && matchedContact.photo_profile) {
                    activeAvatar.innerHTML = `<img src="/uploads/profiles/${matchedContact.photo_profile}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;" />`;
                } else {
                    activeAvatar.textContent = initials;
                    activeAvatar.style.background = 'var(--dusty-mauve)';
                }

                // Show chat window, hide empty state
                chatEmptyState.style.display = 'none';
                chatMainArea.style.display = 'flex';

                // Load Message History
                chatMessages.innerHTML = '<div style="padding:24px;text-align:center;color:rgba(61,43,31,0.5);">Memuat pesan...</div>';
                
                fetch(`/chat/messages/${id}`)
                    .then(response => response.json())
                    .then(messages => {
                        renderMessages(messages);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                        
                        // Clear previous polling
                        if (pollingInterval) clearInterval(pollingInterval);
                        
                        // Start polling for new messages every 3 seconds
                        pollingInterval = setInterval(pollMessages, 3000);
                        
                        // Reload contacts to update read status badges
                        loadContacts(id);
                    })
                    .catch(err => {
                        console.error('Error fetching messages:', err);
                        chatMessages.innerHTML = '<div style="padding:24px;text-align:center;color:red;">Gagal memuat pesan.</div>';
                    });
            }

            // Render Messages List
            function renderMessages(messages) {
                if (messages.length === 0) {
                    chatMessages.innerHTML = '<div style="padding:24px;text-align:center;color:rgba(61,43,31,0.4);font-size:14px;">Belum ada percakapan. Kirim pesan pertama untuk memulai!</div>';
                    return;
                }

                chatMessages.innerHTML = '';
                messages.forEach(msg => {
                    const rowClass = msg.is_sent ? 'sent' : 'received';
                    const avatarInitials = msg.is_sent ? 'ME' : activeName.textContent.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                    const avatarBg = msg.is_sent ? 'var(--warm-amber)' : 'var(--dusty-mauve)';

                    const matchedContact = allContacts.find(c => c.id_user == activeContactId);
                    const avatarContent = (!msg.is_sent && matchedContact && matchedContact.photo_profile)
                        ? `<img src="/uploads/profiles/${matchedContact.photo_profile}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;" />`
                        : avatarInitials;

                    const msgHtml = `
                        <div class="message-row ${rowClass}">
                            <div class="message-avatar" style="background: ${avatarBg};">${avatarContent}</div>
                            <div class="message-group">
                                <div class="message-bubble">
                                    ${escapeHtml(msg.message)}
                                    <span class="message-time">${msg.time}</span>
                                </div>
                            </div>
                        </div>
                    `;
                    chatMessages.insertAdjacentHTML('beforeend', msgHtml);
                });
            }

            // Poll for new messages
            function pollMessages() {
                if (!activeContactId) return;
                
                fetch(`/chat/poll/${activeContactId}`)
                    .then(response => response.json())
                    .then(newMsgs => {
                        if (newMsgs.length > 0) {
                            // If it had the empty chat fallback message, clear it
                            if (chatMessages.querySelector('.message-row') === null) {
                                chatMessages.innerHTML = '';
                            }
                            
                            newMsgs.forEach(msg => {
                                const matchedContact = allContacts.find(c => c.id_user == activeContactId);
                                const avatarInitials = activeName.textContent.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                                const avatarContent = (matchedContact && matchedContact.photo_profile)
                                    ? `<img src="/uploads/profiles/${matchedContact.photo_profile}" style="width:100%; height:100%; object-fit:cover; border-radius:50%;" />`
                                    : avatarInitials;

                                const msgHtml = `
                                    <div class="message-row received">
                                        <div class="message-avatar" style="background: var(--dusty-mauve);">${avatarContent}</div>
                                        <div class="message-group">
                                            <div class="message-bubble">
                                                ${escapeHtml(msg.message)}
                                                <span class="message-time">${msg.time}</span>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                chatMessages.insertAdjacentHTML('beforeend', msgHtml);
                            });
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                        }
                    })
                    .catch(err => console.error('Polling error:', err));
            }

            // Send Message
            function sendMessage() {
                const text = messageInput.value.trim();
                if (text === '' || !activeContactId) return;

                btnSend.disabled = true;

                fetch('{{ route("chat.send") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        receiver_id: activeContactId,
                        message: text
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Clear fallback empty message if any
                        if (chatMessages.querySelector('.message-row') === null) {
                            chatMessages.innerHTML = '';
                        }

                        const msg = data.message;
                        const msgHtml = `
                            <div class="message-row sent">
                                <div class="message-avatar" style="background: var(--warm-amber);">ME</div>
                                <div class="message-group">
                                    <div class="message-bubble">
                                        ${escapeHtml(msg.message)}
                                        <span class="message-time">${msg.time}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                        chatMessages.insertAdjacentHTML('beforeend', msgHtml);
                        messageInput.value = '';
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                        
                        // Refresh contacts sidebar to show updated last message
                        loadContacts(activeContactId);
                    }
                    btnSend.disabled = false;
                })
                .catch(err => {
                    console.error('Send error:', err);
                    alert('Gagal mengirim pesan.');
                    btnSend.disabled = false;
                });
            }

            // Event Listeners for sending
            btnSend.addEventListener('click', sendMessage);
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            // Initial load
            loadContacts();

            // Helpers
            function escapeHtml(text) {
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
        });
    </script>
</body>
</html>

