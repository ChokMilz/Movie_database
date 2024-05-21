pip-install:
	@echo "Installing python packages..."
	pip install mysql-connector-python

pip-clean:
	@echo "Removing python packages..."
	pip freeze | xargs pip uninstall -y

install:
	wget https://sourceforge.net/projects/xampp/files/XAMPP%20Linux/8.2.12/xampp-linux-x64-8.2.12-0-installer.run
	chmod +x xampp-linux-x64-8.2.12-0-installer.run
	sudo ./xampp-linux-x64-8.2.12-0-installer.run
	sudo apt-get install -y mongodb-org

full-setup:
	@echo "Running full setup..."
	@if not exist "C:\xampp" ( \
		echo "Installing dependencies..."; \
		make pip-install && \
		make install; \
	) \
	echo "Setting up XAMPP..."; \
	copy index.php C:\xampp\htdocs && \
	mkdir C:\xampp\htdocs\php && \
	copy php\* C:\xampp\htdocs\php && \
	powershell -Command "Start-Process -Wait -FilePath 'C:\xampp\xampp-control.exe' -ArgumentList 'start'"; \
	echo "Running XAMPP script..."; \
	python xampp-script.py

start:
	@echo "Starting XAMPP..."
	@powershell -Command "Start-Process -Wait -FilePath 'C:\xampp\xampp-control.exe' -ArgumentList 'start'"