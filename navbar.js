class NarbarComponent extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
        <div class="nav">
          <nav>
            <ul>
              <div class="nav">
                <a href="/ship-registration.html">Ship Registration </a>
                <a href="#">Port Entry </a>
                <a href="#">Port Exit </a>
                <a href="/crane-operator.php">Crane Operator</a>
                <a href="/truck-registration.php">Truck Registration</a>
                <a href="/truck-driver-registration.php">Truck Driver Registration</a>
                <a href="#">Container Company Registration</a>
                <a href="#">Port Admin Management</a>
              </div>
          </nav>
        </div>
      `;
  }
}

customElements.define("navbar-component", NarbarComponent);
