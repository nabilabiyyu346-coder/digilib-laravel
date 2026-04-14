<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DigilibSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Kategori
        DB::table('kategoris')->insert([
            ['kodeKategori' => 1, 'namaKategori' => 'Novel'],
        ]);

        // Seed Pengarang
        DB::table('pengarangs')->insert([
            ['kodePengarang' => 1, 'nama' => 'Dan Brown'],
            ['kodePengarang' => 2, 'nama' => 'J.R.R. Tolkien'],
            ['kodePengarang' => 4, 'nama' => 'Deny Herianto'],
        ]);

        // Seed Penerbit
        DB::table('penerbits')->insert([
            [
                'kodePenerbit' => 1,
                'nama' => 'Gramedia',
                'alamat' => 'Jl. Jakarta',
                'telp' => '0899',
                'email' => 'office@gramedia.com'
            ],
        ]);

        // Seed Petugas (Admin)
        DB::table('petugas')->insert([
            [
                'kodePetugas' => 1,
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'nama' => 'Admin',
                'email' => 'admin@eepis-its.edu',
                'dateInput' => '2013-03-22 00:00:00',
                'dateUpdate' => '2013-03-22 00:00:00',
                'tempatLahir' => 'Surabaya',
                'tanggalLahir' => '1990-10-06',
                'alamat' => 'Surabaya',
            ],
        ]);

        // Seed Dosen
        DB::table('dosens')->insert([
            [
                'kodeDosen' => 1,
                'username' => 'dosen',
                'password' => bcrypt('dosen'),
                'nama' => 'Pak Dosen',
                'email' => 'dosen@eepis-its.edu',
                'dateInput' => '2013-03-22 00:00:00',
                'dateUpdate' => '2013-03-22 00:00:00',
                'tempatLahir' => 'Surabaya',
                'tanggalLahir' => '1980-10-08',
                'alamat' => 'Surabaya',
            ],
        ]);

        // Seed Mahasiswa
        DB::table('mahasiswas')->insert([
            [
                'kodeMhs' => 1,
                'username' => 'deny',
                'password' => bcrypt('deny'),
                'nama' => 'Deny Herianto',
                'email' => 'deny.hrnt@gmail.com',
                'dateInput' => '2013-03-22 00:00:00',
                'dateUpdate' => '2013-03-22 00:00:00',
                'tempatLahir' => 'Surabaya',
                'tanggalLahir' => '1993-10-06',
                'alamat' => 'Surabaya',
                'jurusan' => 'Teknik Informatika',
            ],
        ]);

        // Seed Buku
        DB::table('bukus')->insert([
            [
                'kodeBuku' => 1,
                'judul' => 'Lord of The Rings',
                'kodePenerbit' => 1,
                'kodePengarang' => 2,
                'tahun' => 2006,
                'edisi' => '2010',
                'issn_isbn' => '',
                'seri' => '17',
                'abstraksi' => 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
                'kodeKategori' => 1,
                'tglInput' => '2013-03-22 00:00:00',
                'tglUpdate' => '2013-03-30 00:26:36',
                'image' => '',
                'lastUpdateBy' => 1,
            ],
            [
                'kodeBuku' => 2,
                'judul' => 'Angels and Demons',
                'kodePenerbit' => 1,
                'kodePengarang' => 1,
                'tahun' => 2006,
                'edisi' => '5',
                'issn_isbn' => '',
                'seri' => '',
                'abstraksi' => '',
                'kodeKategori' => 1,
                'tglInput' => '2013-03-22 00:00:00',
                'tglUpdate' => '2013-03-22 00:00:00',
                'image' => '',
                'lastUpdateBy' => 1,
            ],
            [
                'kodeBuku' => 6,
                'judul' => 'The Hobbit',
                'kodePenerbit' => 1,
                'kodePengarang' => 2,
                'tahun' => 2000,
                'edisi' => '1',
                'issn_isbn' => '1',
                'seri' => '1',
                'abstraksi' => 'adadasd',
                'kodeKategori' => 1,
                'tglInput' => '2013-03-30 00:46:46',
                'tglUpdate' => '2013-03-30 00:46:46',
                'image' => '',
                'lastUpdateBy' => 1,
            ],
        ]);

        // Seed Pinjam
        DB::table('pinjams')->insert([
            [
                'kodePinjam' => 2013033021,
                'kodePetugas' => 0,
                'kodePeminjam' => 1,
                'tipePeminjam' => 2,
                'tglPinjam' => '2013-03-30 10:16:36',
                'tglKembali' => null,
                'keterangan' => '',
                'status' => 1,
            ],
            [
                'kodePinjam' => 2013033031,
                'kodePetugas' => 1,
                'kodePeminjam' => 1,
                'tipePeminjam' => 3,
                'tglPinjam' => '2013-03-30 10:17:47',
                'tglKembali' => null,
                'keterangan' => '',
                'status' => 2,
            ],
        ]);

        // Seed PinjamDetail
        DB::table('pinjam_details')->insert([
            ['kodePinjamDetail' => 17, 'kodePinjam' => 2013033021, 'kodeBuku' => 2],
            ['kodePinjamDetail' => 18, 'kodePinjam' => 2013033021, 'kodeBuku' => 1],
            ['kodePinjamDetail' => 19, 'kodePinjam' => 2013033031, 'kodeBuku' => 2],
        ]);
    }
}

