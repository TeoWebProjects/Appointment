function createModal() {
  const body = document.querySelector('body')

  const modalContainer = document.createElement('div')
  modalContainer.classList.add('modal-container')
  body.appendChild(modalContainer)

  const modal = document.createElement('div')
  modal.classList.add('modal')
  modalContainer.appendChild(modal)

  const xButton = document.createElement('div')
  xButton.classList.add('x-button')
  xButton.innerText = 'x'
  modal.appendChild(xButton)

  xButton.addEventListener('click', () => {
    modalContainer.remove()
  })

  const title = document.createElement('div')
  title.classList.add('title')
  title.innerText = 'Δημιουργία Ραντεβού'
  modal.appendChild(title)

  const form = document.createElement('form')
  form.classList.add('form-create')
  form.setAttribute('method', 'POST')
  modal.appendChild(form)

  const formInputTitle = document.createElement('div')
  formInputTitle.classList.add('form-input')
  form.appendChild(formInputTitle)

  const formTitle = document.createElement('div')
  formTitle.classList.add('form-title')
  formTitle.innerText = 'Τίτλος'
  formInputTitle.appendChild(formTitle)

  const formInput = document.createElement('input')
  formInput.classList.add('full-w')
  formInput.setAttribute('name', 'title')
  formInput.setAttribute('id', 'title')
  formInputTitle.appendChild(formInput)

  const formInputComments = document.createElement('div')
  formInputComments.classList.add('form-input')
  form.appendChild(formInputComments)

  const formComments = document.createElement('div')
  formComments.classList.add('form-title')
  formComments.innerText = 'Σχόλια'
  formInputComments.appendChild(formComments)

  const formInput2 = document.createElement('input')
  formInput2.classList.add('full-w')
  formInput2.setAttribute('name', 'comments')
  formInput2.setAttribute('id', 'comments')
  formInputComments.appendChild(formInput2)

  const formInputStart = document.createElement('div')
  formInputStart.classList.add('form-input')
  form.appendChild(formInputStart)

  const formStart = document.createElement('div')
  formStart.classList.add('form-title')
  formStart.innerText = 'Εναρξη'
  formInputStart.appendChild(formStart)

  const inputTimeStart = document.createElement('input')
  inputTimeStart.setAttribute('type', 'time')
  inputTimeStart.setAttribute('step', '1')
  inputTimeStart.setAttribute('name', 'starttime')
  inputTimeStart.setAttribute('id', 'starttime')
  inputTimeStart.classList.add('full-w')
  formInputStart.appendChild(inputTimeStart)

  const formInputEnd = document.createElement('div')
  formInputEnd.classList.add('form-input')
  form.appendChild(formInputEnd)

  const formEnd = document.createElement('div')
  formEnd.classList.add('form-title')
  formEnd.innerText = 'Λήξη'
  formInputEnd.appendChild(formEnd)

  const inputTimeEnd = document.createElement('input')
  inputTimeEnd.setAttribute('type', 'time')
  inputTimeEnd.setAttribute('step', '1')
  inputTimeEnd.setAttribute('name', 'endtime')
  inputTimeEnd.setAttribute('id', 'endtime')
  inputTimeEnd.classList.add('full-w')
  formInputEnd.appendChild(inputTimeEnd)

  const button = document.createElement('button')
  button.classList.add('addButton')
  button.textContent = 'Δημιουργία'
  form.appendChild(button)
}

function updateModal(info) {
  const body = document.querySelector('body')

  const modalContainer = document.createElement('div')
  modalContainer.classList.add('modal-container')
  body.appendChild(modalContainer)

  const modal = document.createElement('div')
  modal.classList.add('modal')
  modalContainer.appendChild(modal)

  const xButton = document.createElement('div')
  xButton.classList.add('x-button')
  xButton.innerText = 'x'
  modal.appendChild(xButton)

  xButton.addEventListener('click', () => {
    modalContainer.remove()
  })

  const title = document.createElement('div')
  title.classList.add('title')
  title.innerText = 'Eπεξεργασία Ραντεβού'
  modal.appendChild(title)

  const form = document.createElement('form')
  form.classList.add('form-update')
  form.setAttribute('method', 'POST')
  modal.appendChild(form)

  const formInputTitle = document.createElement('div')
  formInputTitle.classList.add('form-input')
  form.appendChild(formInputTitle)

  const formTitle = document.createElement('div')
  formTitle.classList.add('form-title')
  formTitle.innerText = 'Τίτλος'
  formInputTitle.appendChild(formTitle)

  const formInput = document.createElement('input')
  formInput.classList.add('full-w')
  formInput.setAttribute('name', 'title')
  formInput.setAttribute('id', 'title')
  formInput.value = info.event.title
  formInputTitle.appendChild(formInput)

  const formInputComments = document.createElement('div')
  formInputComments.classList.add('form-input')
  form.appendChild(formInputComments)

  const formComments = document.createElement('div')
  formComments.classList.add('form-title')
  formComments.innerText = 'Σχόλια'
  formInputComments.appendChild(formComments)

  const formInput2 = document.createElement('input')
  formInput2.classList.add('full-w')
  formInput2.setAttribute('name', 'comments')
  formInput2.setAttribute('id', 'comments')
  formInput2.value = info.event._def.extendedProps.comments
  formInputComments.appendChild(formInput2)

  const formInputStart = document.createElement('div')
  formInputStart.classList.add('form-input')
  form.appendChild(formInputStart)

  const formStart = document.createElement('div')
  formStart.classList.add('form-title')
  formStart.innerText = 'Εναρξη'
  formInputStart.appendChild(formStart)

  const inputTimeStart = document.createElement('input')

  let startHour = info.event.start.getHours()
  let startMinutes = info.event.start.getMinutes()
  let startSeconds = info.event.start.getSeconds()

  if (startHour < 10) {
    startHour = `0${startHour.toString()}`
  }
  if (startMinutes < 10) {
    startMinutes = `0${startMinutes.toString()}`
  }
  if (startSeconds < 10) {
    startSeconds = `0${startSeconds.toString()}`
  }

  inputTimeStart.value = `${startHour}:${startMinutes}:${startSeconds}`
  inputTimeStart.setAttribute('type', 'time')
  inputTimeStart.setAttribute('name', 'starttime')
  inputTimeStart.setAttribute('step', '1')
  inputTimeStart.setAttribute('id', 'starttime')
  inputTimeStart.classList.add('full-w')
  formInputStart.appendChild(inputTimeStart)

  const formInputEnd = document.createElement('div')
  formInputEnd.classList.add('form-input')
  form.appendChild(formInputEnd)

  const formEnd = document.createElement('div')
  formEnd.classList.add('form-title')
  formEnd.innerText = 'Λήξη'
  formInputEnd.appendChild(formEnd)

  const inputTimeEnd = document.createElement('input')

  let endHour = info.event.end.getHours()
  let endMinutes = info.event.end.getMinutes()
  let endSeconds = info.event.end.getSeconds()

  if (endHour < 10) {
    endHour = `0${endHour.toString()}`
  }
  if (endMinutes < 10) {
    endMinutes = `0${endMinutes.toString()}`
  }
  if (endSeconds < 10) {
    endSeconds = `0${endSeconds.toString()}`
  }

  inputTimeEnd.value = `${endHour}:${endMinutes}:${endSeconds}`
  inputTimeEnd.setAttribute('type', 'time')
  inputTimeEnd.setAttribute('step', '1')
  inputTimeEnd.setAttribute('name', 'endtime')
  inputTimeEnd.setAttribute('id', 'endtime')
  inputTimeEnd.classList.add('full-w')
  formInputEnd.appendChild(inputTimeEnd)

  const button = document.createElement('button')
  button.classList.add('updateButton')
  button.textContent = 'Επεξεργασία'
  form.appendChild(button)
}
