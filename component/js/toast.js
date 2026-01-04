// toast.js
export function showToast(message, type = "success") {
    const toast = document.createElement("div")
    toast.className = `
        fixed bottom-4 right-4
        px-4 py-3 rounded-lg text-white
        transition transform duration-300
        translate-y-full opacity-0
        ${type === "success" ? "bg-green-500" : "bg-red-500"}
    `
    toast.textContent = message

    document.body.appendChild(toast)

    requestAnimationFrame(() => {
        toast.classList.remove("translate-y-full", "opacity-0")
    })

    setTimeout(() => {
        toast.classList.add("translate-y-full", "opacity-0")
        setTimeout(() => toast.remove(), 300)
    }, 3000)
}
