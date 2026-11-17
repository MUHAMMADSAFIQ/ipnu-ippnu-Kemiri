# ENTITY RELATIONSHIP DIAGRAM (ERD)

ERD memodelkan relasi konseptual antarentitas di dalam database SQLite Sistem Informasi Portal Web dan E-Voting PAC IPNU IPPNU Kemiri:

```mermaid
erDiagram
    users {
        INTEGER id PK
        VARCHAR name
        VARCHAR email UK
        VARCHAR password
        TIMESTAMP created_at
    }

    articles {
        INTEGER id PK
        VARCHAR title
        VARCHAR slug UK
        TEXT content
        VARCHAR image
        VARCHAR author
        INTEGER views_count
        INTEGER comments_count
        VARCHAR status
        TIMESTAMP published_at
    }

    comments {
        INTEGER id PK
        INTEGER article_id FK
        INTEGER parent_id FK
        VARCHAR name
        TEXT content
        INTEGER likes_count
        TIMESTAMP created_at
    }

    registrations {
        INTEGER id PK
        VARCHAR name
        VARCHAR email UK
        VARCHAR phone
        VARCHAR birth_place
        DATE birth_date
        VARCHAR education
        DATE makesta_date
        TEXT address
        TIMESTAMP created_at
    }

    candidates {
        INTEGER id PK
        VARCHAR name
        VARCHAR photo
        TEXT vision
        TEXT mission
        INTEGER nomor_urut
        VARCHAR asal_ranting
        VARCHAR jabatan_sebelumnya
        VARCHAR jenis_kelamin
        VARCHAR angkatan
        INTEGER votes_count
        BOOLEAN is_active
    }

    votes {
        INTEGER id PK
        INTEGER candidate_id FK
        VARCHAR ip_address
        TIMESTAMP created_at
    }

    visitors {
        INTEGER id PK
        VARCHAR ip_address
        VARCHAR os
        VARCHAR browser
        DATE visit_date
    }

    products {
        INTEGER id PK
        VARCHAR name
        TEXT description
        VARCHAR category
        INTEGER price
        INTEGER discount
        VARCHAR condition
        INTEGER stock
        VARCHAR location
        INTEGER sold_count
        NUMERIC rating
        VARCHAR wa_link
        VARCHAR image
    }

    feedbacks {
        INTEGER id PK
        VARCHAR name
        VARCHAR subject
        VARCHAR contact
        TEXT message
        BOOLEAN is_read
        TIMESTAMP created_at
    }

    chat_messages {
        INTEGER id PK
        VARCHAR author
        TEXT content
        TIMESTAMP created_at
    }

    articles ||--o{ comments : "has many"
    comments ||--o{ comments : "has replies (self-relation)"
    candidates ||--o{ votes : "accumulates"
```

### Penjelasan Detil Entitas ERD:
* **`users`**: Menyimpan kredensial otentikasi login administrator.
* **`articles` & `comments`**: Menyimpan data berita kegiatan organisasi serta komentar bersarang (*nested comments*) dari pembaca.
* **`registrations`**: Menyimpan data formulir pendaftaran daring calon anggota baru MAKESTA.
* **`candidates` & `votes`**: Menyimpan profil lengkap calon ketua PAC, status keaktifan bilik suara, total akumulasi perolehan suara, serta log unik IP Address pemilih.
* **`visitors`**: Menyimpan log harian parameter IP Address, tipe sistem operasi, dan browser pengunjung portal.
* **`products`**: Menyimpan katalog lengkap produk Lapak Usaha UMKM milik kader.
* **`feedbacks` & `chat_messages`**: Menampung kiriman saran/kritik Ruang Lapor serta log obrolan chatbot.
