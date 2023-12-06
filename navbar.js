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
                <a href="/signup.php">Register </a>
                <a href="/login.php">Login </a>
                <a href="/ship-register.php">Ship Registration </a>
                <a href="/port-entry.php">Port Entry </a>
                <a href="/port-exit.php">Port Exit </a>
                <a href="/crane-operator.php">Crane Operator</a>
                <a href="/truck-registration.php">Truck Registration</a>
                <a href="/truck-driver-registration.php">Truck Driver Registration</a>
                <a href="/container-registration.php">Container Registration</a>
                <a href="/port-admin-management.php">Port Admin</a>
              </div>
          </nav>
        </div>
      `;
  }
}

customElements.define("navbar-component", NarbarComponent);
