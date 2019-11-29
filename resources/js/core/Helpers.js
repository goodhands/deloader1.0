class Helpers{
    fakeContentContainer(content){
        let div = document.createElement('div');
        div.innerHTML = content;
        let textContent = div.textContent || div.innerText || "";
        return textContent;
    }

    readTime(html_content){
        let textContent = this.fakeContentContainer(html_content);
        let wordCount = textContent.split(" ").length;
        let avgTime = 250; //250wpm
        let readTime = wordCount / avgTime;
        let result = Math.ceil(readTime);
        result+= window.screen.width <= 500 ? " min" : " min read";
        return result.toString();
    }
}

export default Helpers;