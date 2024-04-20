import { Viewer, Worker } from '@react-pdf-viewer/core'
import PaperPDF from '@/paper.pdf'

const Paper = () => {
  return (
    <Worker workerUrl='https://unpkg.com/pdfjs-dist@3.4.120/build/pdf.worker.min.js'>
      <Viewer
        fileUrl={PaperPDF}
      />
    </Worker>
  )
}

export default Paper
