window.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('a').forEach(a => {
          a.addEventListener('click', () => {
              //event.preventDefault();
              var loader = document.createElement('div');
              loader.classList.add('loader');
              if(a.parentNode) {
                  a.parentNode.classList.add('loading')
                  a.parentNode.appendChild(loader)
              }
          })
      })
})
