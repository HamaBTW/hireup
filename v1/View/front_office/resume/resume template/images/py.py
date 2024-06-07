import base64

# Load image
with open('avatar.jpg', 'rb') as image_file:
    # Read image as binary
    binary_image = image_file.read()

# Encode the binary image to base64
base64_image = base64.b64encode(binary_image).decode('utf-8')

# Display the base64 string
print(base64_image)