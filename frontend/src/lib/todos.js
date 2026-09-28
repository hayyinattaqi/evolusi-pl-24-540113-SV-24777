export function hitungSelesai(todos) {
  return todos.filter((todo) => todo.is_done).length
}

export function ringkasan(todos) {
  const selesai = hitungSelesai(todos)
  return `${selesai} dari ${todos.length} tugas selesai`
}