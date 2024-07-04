import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
  const button = document.querySelector('.animate-button');
  button.addEventListener('mouseover', function() {
      this.style.backgroundColor = '#0056b3';
  });
  button.addEventListener('mouseout', function() {
      this.style.backgroundColor = '#007bff';
  });
});