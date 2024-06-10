from AiManagerHamaBTW import AiManager

import os

def clean_img_data(data):
    """Removes the data:image/jpeg;base64, from the image data file"""
    data = data.split("base64,")[1]
    return data


def get_promt(filename):
    if os.path.exists(filename):
        pass
    else:
        return False
    
    with open(filename, "r") as f:
        data = f.read()
        return data.strip()

def get_img_promt(filename):
    if os.path.exists(filename):
        pass
    else:
        return False
    
    with open(filename, "r") as f:
        data = f.read()
        data = clean_img_data(data)
        return data.strip()

def delete_data_file(file_path):
    if os.path.exists(file_path):
        # Delete the file
        os.remove(file_path)
        return True
    else:
        return False


current_file_dir = os.path.dirname(os.path.realpath(__file__))

#ai = AiManager(page=None, ai_model='llama2-uncensored')
ai = AiManager(page=None, ai_model='llava')

param_value = get_promt(filename=f"{current_file_dir}/data.hiry")
img_value = get_img_promt(filename=f"{current_file_dir}/image_data.hiry")

if param_value == False:
    print("error fetching the response")
    delete_data_file("data.hiry")
    delete_data_file("image_data.hiry")
    exit()

prompt = param_value
img_prompt = img_value
if img_prompt == False:
    rep = ai.send_the_prompt(prompt)
else:
    rep = ai.send_the_prompt(prompt, images=[img_prompt])
try:
    print(rep['data got']['response'])
    delete_data_file("data.hiry")
    delete_data_file("image_data.hiry")
except:
    print("error fetching the response")
    delete_data_file("data.hiry")
    delete_data_file("image_data.hiry")
    

