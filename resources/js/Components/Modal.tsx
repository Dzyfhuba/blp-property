import { DialogHTMLAttributes, forwardRef } from 'react'

interface Props extends React.DetailedHTMLProps<DialogHTMLAttributes<HTMLDialogElement>, HTMLDialogElement> { }

const Modal = (props: Props, ref: React.ForwardedRef<HTMLDialogElement>) => {
  return (
    <dialog className="modal" ref={ref}>
      <div className="modal-box">
        <form method="dialog">
          {/* if there is a button in form, it will close the modal */}
          <button className="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div>
          {props.children}
        </div>
      </div>
      <form method="dialog" className="modal-backdrop">
        <button>close</button>
      </form>
    </dialog>
  )
}

export default forwardRef(Modal)