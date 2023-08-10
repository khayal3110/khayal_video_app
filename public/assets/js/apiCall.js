const photoGrid = document.getElementById('photoGrid')
const photoCountElement = document.getElementById('totalPhotos')

// window.addEventListener('load', function () {
//    let photoCount = 0
//    // Make API call using Fetch
//    fetch('https://jsonplaceholder.typicode.com/albums/2/photos')
//       .then(function (response) {
//          if (!response.ok) {
//             throw new Error('Network response was not ok')
//          }
//          return response.json()
//       })
//       .then(function (data) {
//          // Process the received data
//          console.log('==>', data)

//          // Create photo items and append them to the photo grid
//          data.forEach(function (photo) {
//             const photoItem = document.createElement('div')
//             photoItem.classList.add('photo-item')

//             const photoImage = document.createElement('img')
//             photoImage.classList.add('photo-image')
//             photoImage.src = photo.url
//             photoImage.alt = photo.title

//             const photoTitle = document.createElement('h3')
//             photoTitle.textContent = photo.title

//             photoItem.appendChild(photoImage)
//             photoItem.appendChild(photoTitle)

//             // Add onclick event to fade out and remove photo item
//             photoItem.addEventListener('click', function () {
//                photoItem.style.transition = 'opacity 0.5s'
//                photoItem.style.opacity = '0'

//                setTimeout(function () {
//                   photoItem.remove()
//                   photoCount--
//                   updatePhotoCount()
//                }, 500)
//             })

//             photoGrid.appendChild(photoItem)
//             photoCount++

//             // Update the photo count element
//             function updatePhotoCount() {
//                photoCountElement.textContent = `Number of photos: ${photoCount}`
//             }

//             updatePhotoCount()
//          })
//       })
//       .catch(function (error) {
//          // Handle any errors that occurred during the API call
//          console.log('Error:', error.message)
//       })
// })
