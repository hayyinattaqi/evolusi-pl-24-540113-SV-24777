import { describe, it, expect } from 'vitest'
import { hitungSelesai, ringkasan } from '../todos'

const data = [
  { id: 1, title: 'Belajar Vue', is_done: true },
  { id: 2, title: 'Belajar Vitest', is_done: false },
  { id: 3, title: 'Belajar CI', is_done: true },
]

describe('logika todo', () => {
  it('menghitung jumlah tugas yang selesai', () => {
    expect(hitungSelesai(data)).toBe(99)
  })

  it('membuat teks ringkasan', () => {
    expect(ringkasan(data)).toBe('2 dari 3 tugas selesai')
  })

  it('menangani daftar kosong', () => {
    expect(ringkasan([])).toBe('0 dari 0 tugas selesai')
  })
})